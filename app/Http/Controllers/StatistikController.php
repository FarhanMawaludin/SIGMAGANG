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
        // statistik
        $accepted_per_year = Pengajuan::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->where('status', 'accepted')
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        $years = $accepted_per_year->pluck('year')->toArray();
        $totals = $accepted_per_year->pluck('total')->toArray();
        

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
            'activemenu' => $activemenu,
            'dosen' => $dosen_plot,
            
        );
         return view('admin.statistik.index',$data);
    }
}
