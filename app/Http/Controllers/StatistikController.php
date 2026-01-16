<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pengajuan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;


class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Dosen
        $dosen_count = User::where('role', 'dosen_pembimbing')->count();
        $dosen_plot = User::where('role', 'dosen_pembimbing')
            ->with(['dosenPembimbing.pengajuans' => function ($query) {
                $query->select('dosen_id', 'mahasiswa_id');
            }])
            ->get()
            ->map(function ($user) {
                $jumlah = $user->dosenPembimbing
                    ? $user->dosenPembimbing->pengajuans->pluck('mahasiswa_id')->unique()->count()
                    : 0;
                $user->jumlah_mahasiswa = $jumlah;
                return $user;
            })
            ->sortByDesc('jumlah_mahasiswa')
            ->take(5)
            ->values();

        $max_mahasiswa = $dosen_plot->max('jumlah_mahasiswa');

        // Lowongan
        $lowongan_count = Lowongan::count();

        // Pengajuan
        $pengajuan_count = Pengajuan::count();
        $mahasiswa_dibimbing_count = Pengajuan::whereIn('status', ['accepted', 'completed'])
            ->distinct('mahasiswa_id')
            ->count('mahasiswa_id');
        $dosen_pembimbing_count = Pengajuan::whereIn('status', ['accepted', 'completed'])
            ->distinct('dosen_id')
            ->count('dosen_id');
        $ratio_mahasiswa_per_dosen = $dosen_pembimbing_count > 0
            ? $mahasiswa_dibimbing_count / $dosen_pembimbing_count
            : 0;

        // Statistik tahunan
        $accepted_per_year = Pengajuan::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->whereIn('status', ['accepted', 'completed'])
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        $years = $accepted_per_year->pluck('year')->toArray();
        $totals = $accepted_per_year->pluck('total')->toArray();

        // Statistik bulanan jika tahun dipilih
        $selectedYear = $request->input('year');
        $monthlyData = [];

        if ($selectedYear) {
            $monthlyAcceptedPengajuan = Pengajuan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->whereIn('status', ['accepted', 'completed'])
                ->whereYear('created_at', $selectedYear)
                ->groupByRaw('MONTH(created_at)')
                ->orderBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData[] = $monthlyAcceptedPengajuan[$i] ?? 0;
            }
        }

        // Perusahaan
        $perusahaan_count = Perusahaan::count();

        // Magang (status accepted)
        $magang_count = Pengajuan::where('status', 'accepted')->count();

        // Pie chart: 5 skill dengan peminat terbanyak + kategori "Lainnya"
        $skills = Skill::withCount('mahasiswa')
            ->get()
            ->sortByDesc('mahasiswa_count')
            ->values();

        $topSkills = $skills->take(4);
        $otherSkills = $skills->slice(4);

        $othersTotal = 0;
        $otherSkillsDetail = [];

        if ($otherSkills->count() > 0) {
            $othersTotal = $otherSkills->sum('mahasiswa_count');

            // Buat array of object detail lainnya
            $otherSkillsDetail = $otherSkills->map(function ($skill) {
                return [
                    'nama' => $skill->nama,
                    'jumlah' => $skill->mahasiswa_count
                ];
            })->values()->toArray();

            // Tambahkan "Lainnya" ke topSkills
            $topSkills->push((object)[
                'nama' => 'Lainnya',
                'mahasiswa_count' => $othersTotal
            ]);
        }

        $skillLabels = $topSkills->pluck('nama')->toArray();
        $skillCounts = $topSkills->pluck('mahasiswa_count')->toArray();
        $puas = Pengajuan::where('status', 'completed')
            ->whereNotNull('kepuasan')
            ->where('kepuasan', 'Puas')
            ->count();
        $sangat_puas = Pengajuan::where('status', 'completed')
            ->whereNotNull('kepuasan')
            ->where('kepuasan', 'Sangat Puas')
            ->count();
        $tidak_puas = Pengajuan::where('status', 'completed')
            ->whereNotNull('kepuasan')
            ->where('kepuasan', 'Tidak Puas')
            ->count();
        $activemenu = 'statistik';

        return view('admin.statistik.index', [
            'dosen_count' => $dosen_count,
            'lowongan_count' => $lowongan_count,
            'pengajuan_count' => $pengajuan_count,
            'perusahaan_count' => $perusahaan_count,
            'magang_count' => $magang_count,
            'years' => $years,
            'totals' => $totals,
            'monthlyData' => $monthlyData,
            'selectedYear' => $selectedYear,
            'activemenu' => $activemenu,
            'dosen' => $dosen_plot,
            'mahasiswa_dibimbing_count' => $mahasiswa_dibimbing_count,
            'dosen_pembimbing_count' => $dosen_pembimbing_count,
            'ratio_mahasiswa_per_dosen' => $ratio_mahasiswa_per_dosen,
            'max_mahasiswa' => $max_mahasiswa,
            'skillLabels' => $skillLabels,
            'puas' => $puas,
            'sangat_puas' => $sangat_puas,
            'tidak_puas' => $tidak_puas,
            'skillCounts' => $skillCounts,
            'otherSkillsDetail' => $otherSkillsDetail, 
        ]);
    }

    public function export_excel(Request $request)
    {
        $year = $request->query('year');

        // Query dasar
        $query = Pengajuan::query()->where('status', 'completed');

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        $pengajuan = $query->with(['mahasiswa.user', 'lowongan', 'dosen'])->orderBy('created_at')->get();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0); // Hapus sheet default

        $bulanMap = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        if ($year) {
            // Filter berdasarkan tahun → sheet per bulan
            $grouped = $pengajuan->groupBy(function ($item) {
                return $item->created_at->format('m'); // Group by bulan
            });

            foreach ($grouped as $bulan => $items) {
                $sheet = $spreadsheet->createSheet();
                $sheet->setTitle($bulanMap[intval($bulan)] ?? 'Bulan ' . $bulan);
                $this->isiSheet($sheet, $items, true); // parameter true = tampilkan kolom Tahun
            }
        } else {
            // Tidak ada filter tahun → sheet per tahun, isi per bulan
            $groupedByYear = $pengajuan->groupBy(function ($item) {
                return $item->created_at->format('Y');
            });

            foreach ($groupedByYear as $tahun => $itemsByYear) {
                $sheet = $spreadsheet->createSheet();
                $sheet->setTitle("Tahun $tahun");

                // Header
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Bulan');
                $sheet->setCellValue('C1', 'NIM');
                $sheet->setCellValue('D1', 'Mahasiswa');
                $sheet->setCellValue('E1', 'Lowongan');
                $sheet->setCellValue('F1', 'Perusahaan');
                $sheet->setCellValue('G1', 'Bidang Perusahaan');
                $sheet->setCellValue('H1', 'Jenis Magang');
                $sheet->setCellValue('I1', 'Dosen Pembimbing');
                $sheet->getStyle('A1:G1')->getFont()->setBold(true);

                $groupedByMonth = $itemsByYear->groupBy(function ($item) {
                    return $item->created_at->format('m');
                });

                $row = 2;
                $no = 1;

                foreach ($groupedByMonth as $bulan => $items) {
                    foreach ($items as $item) {
                        $sheet->setCellValue("A$row", $no++);
                        $sheet->setCellValue("B$row", $bulanMap[intval($bulan)] ?? $bulan);
                        $sheet->setCellValue("C$row", $item->mahasiswa->nim ?? '-');
                        $sheet->setCellValue("D$row", $item->mahasiswa->user->name ?? '-');
                        $sheet->setCellValue("E$row", $item->lowongan->nama ?? '-');
                        $sheet->setCellValue("F$row", $item->lowongan->perusahaan->nama ?? '-');
                        $sheet->setCellValue("G$row", $item->lowongan->perusahaan->bidangPerusahaan->nama_bidang ?? '-');
                        $sheet->setCellValue("H$row", $item->lowongan->jenisMagang->jenis_magang ?? '-');
                        $sheet->setCellValue("I$row", $item->dosen->user->name ?? '-');
                        $row++;
                    }
                }

                // Jadikan area A1:G$row menjadi tabel
                $lastDataRow = $row - 1;
                $tableRange = "A1:I$lastDataRow";
                $table = new Table($tableRange);

                // Style opsional
                $tableStyle = new TableStyle();
                $tableStyle->setShowRowStripes(true);
                $table->setStyle($tableStyle);

                // Tambahkan tabel ke sheet
                $sheet->addTable($table);

                // Set auto-size kolom
                foreach (range('A', 'I') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        }

        $fileName = 'Data Pengajuan' . ($year ? " Tahun $year" : ' Semua Tahun') . ' - ' . date('Y-m-d_His') . '.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        // Output file ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    private function isiSheet($sheet, $items, $showYear = false)
    {
        $colOffset = $showYear ? 1 : 0;

        // Header
        $col = 1;
        $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . '1', 'No');

        if ($showYear) {
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . '1', 'Tahun');
        }

        $headers = [
            'NIM',
            'Mahasiswa',
            'Prodi',
            'Lowongan',
            'Perusahaan',
            'Bidang Perusahaan',
            'Jenis Magang',
            'Dosen Pembimbing',
        ];

        foreach ($headers as $header) {
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . '1', $header);
        }

        $totalColumns = count($headers) + 1 + $colOffset;
        $lastCol = Coordinate::stringFromColumnIndex($totalColumns);
        $sheet->getStyle("A1:{$lastCol}1")->getFont()->setBold(true);

        // Data
        $row = 2;
        $no = 1;
        foreach ($items as $item) {
            $col = 1;
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, $no++);

            if ($showYear) {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, $item->created_at->format('Y'));
            }

            $data = [
                $item->mahasiswa->nim ?? '-',
                $item->mahasiswa->user->name ?? '-',
                $item->mahasiswa->prodi->nama ?? '-',
                $item->lowongan->nama ?? '-',
                $item->lowongan->perusahaan->nama ?? '-',
                $item->lowongan->perusahaan->bidangPerusahaan->nama_bidang ?? '-',
                $item->lowongan->jenismagang->jenis_magang ?? '-',
                $item->dosen->user->name ?? '-',
            ];

            foreach ($data as $val) {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, $val);
            }

            $row++;
        }

        // Autosize kolom
        for ($i = 1; $i <= $totalColumns; $i++) {
            $colLetter = Coordinate::stringFromColumnIndex($i);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        $lastDataRow = $row - 1;
        $tableRange = 'A1:' . Coordinate::stringFromColumnIndex($totalColumns) . $lastDataRow;

        $table = new Table($tableRange);
        $tableStyle = new TableStyle();
        $tableStyle->setShowRowStripes(true);
        $table->setStyle($tableStyle);

        $sheet->addTable($table);
    }


}
