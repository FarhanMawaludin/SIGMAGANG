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


    $pengajuanList = Pengajuan::with(['mahasiswa.user', 'lowongan.perusahaan', 'lowongan.jenisMagang'])
        ->where('dosen_id', $dosenId)
        ->where('status', 'accepted')
        ->paginate(10);

    return view('dosen.monitoring.index', compact('activemenu', 'pengajuanList'));
}
   public function show($pengajuan_id)
{
    $activemenu = 'monitoring';
    $user = Auth::user();

    $pengajuan = Pengajuan::with(['mahasiswa.user', 'lowongan.perusahaan', 'lowongan.jenisMagang'])
        ->where('id', $pengajuan_id)
        ->where('dosen_id', $user->dosen->id)
        ->first();

    if (!$pengajuan) {
        return redirect()->route('dosen.monitoring.index')->with('error', 'Pengajuan tidak ditemukan.');
    }
    $logMingguan = LogMingguan::with('logHarian')
        ->where('pengajuan_id', $pengajuan->id)
        ->orderBy('minggu')
        ->paginate(10);

    return view('dosen.monitoring.show', compact('activemenu', 'pengajuan', 'logMingguan'));
}
public function show_harian($logMingguanId)
{
    $activemenu = 'monitoring';
    $user = Auth::user();


    $logMingguan = LogMingguan::with(['logHarian', 'pengajuan.mahasiswa.user'])
        ->where('id', $logMingguanId)
        ->whereHas('pengajuan', function($q) use ($user) {
            $q->where('dosen_id', $user->dosen->id);
        })
        ->firstOrFail();

    return view('dosen.monitoring.show_harian', compact('activemenu', 'logMingguan'));
}
}