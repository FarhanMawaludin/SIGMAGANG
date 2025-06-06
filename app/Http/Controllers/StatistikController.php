<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pengajuan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

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
        $puas = Pengajuan::where('status','completed')
        ->whereNotNull('kepuasan')
        ->where('kepuasan', 'Puas')
        ->count();
        $sangat_puas = Pengajuan::where('status','completed')
        ->whereNotNull('kepuasan')
        ->where('kepuasan', 'Sangat Puas')
        ->count();
        $tidak_puas = Pengajuan::where('status','completed')
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
            'otherSkillsDetail' => $otherSkillsDetail, // dikirim ke view
        ]);
    }
}
