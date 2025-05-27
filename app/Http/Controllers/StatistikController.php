<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pengajuan;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        //dosen
        $dosen_count =  User::where('role', 'dosen_pembimbing')->count();
        $dosen_plot = User::where('role', 'dosen_pembimbing')->get();

        //lowongan
        $lowongan_count = Lowongan::count();

        //pengajuan
        $pengajuan_count = Pengajuan::count();
        $mahasiswa_dibimbing_count = Pengajuan::whereIn('status', ['accepted', 'completed'])
            ->distinct('mahasiswa_id')
            ->count('mahasiswa_id');
        $dosen_pembimbing_count = Pengajuan::whereIn('status', ['accepted', 'completed'])
            ->distinct('dosen_id')
            ->count('dosen_id');
        $ratio_mahasiswa_per_dosen = $dosen_pembimbing_count > 0
            ? round($mahasiswa_dibimbing_count / $dosen_pembimbing_count, 2)
            : 0;


        // statistik
        $accepted_per_year = Pengajuan::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->whereIn('status', ['accepted', 'completed'])
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        $years = $accepted_per_year->pluck('year')->toArray();
        $totals = $accepted_per_year->pluck('total')->toArray();

        // tambahan: statistik bulanan berdasarkan tahun terpilih
        $selectedYear = request('year') ?? null;

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

        //perusahaan
        $perusahaan_count = Perusahaan::count();

        //magang
        $magang_count = Pengajuan::where('status', 'accepted')->count();
        $activemenu = 'statistik';

        $data = array(
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

        );
        return view('admin.statistik.index', $data);
    }
}