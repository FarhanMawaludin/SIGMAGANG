<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\LogMingguan;
use App\Models\Pengajuan;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MonitoringDosenController extends Controller
{
    public function index()
    {
        $activemenu = 'monitoring';
        $user = Auth::user();
        
        $dosenId = $user->dosen->id;
        // dd($dosenId);


        $pengajuanIDs = Pengajuan::where('dosen_id', $dosenId) 
            ->where('status', 'accepted')
            ->pluck('id');
        // dd($pengajuanIDs->toArray());

        if ($pengajuanIDs->isEmpty()) {
            $logs = collect();
            return view('dosen.monitoring.index', compact('activemenu', 'logs'))
                ->with('error', 'Belum ada mahasiswa yang Anda bimbing.');
        }

        // Ambil semua ID dari log mingguan berdasarkan pengajuan
        $logMingguanIDs = LogMingguan::whereIn('pengajuan_id', $pengajuanIDs)->pluck('id');
        // dd($logMingguanIDs->toArray());

        // Ambil semua log harian dari log mingguan
        $logs = LogHarian::whereIn('log_mingguan_id', $logMingguanIDs)
            ->orderByDesc('tanggal')
            ->paginate(10);
        // dd($logs);

        return view('dosen.monitoring.index', compact('activemenu', 'logs'));
    }
}
