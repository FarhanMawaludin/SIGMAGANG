<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\LogMingguan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringMahasiswaController extends Controller
{
    public function index()
    {
        $activemenu = 'monitoring';
        $user = Auth::user();
        // dd($user);

        $pengajuan =Pengajuan::with('mahasiswa.user')
            ->where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();
        // dd($pengajuan->toArray());

        if (!$pengajuan) {
            $logs = collect();
            return view('mahasiswa.monitoring.index', compact('activemenu', 'logs'))
                ->with('error', 'Anda belum memiliki pengajuan yang disetujui.');
        }

        $logMingguanIDs = LogMingguan::where('pengajuan_id', $pengajuan->id)->pluck('id');

        $logs = LogHarian::with('logMingguan.pengajuan.mahasiswa.user')
            ->whereIn('log_mingguan_id', $logMingguanIDs)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('mahasiswa.monitoring.index', compact('activemenu', 'logs'));
    }



    public function create()
    {
        $activemenu = 'monitoring';
        return view('mahasiswa.monitoring.create', ['activemenu' => $activemenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'aktivitas'     => 'required|string|max:1000',
            'tanggal'       => 'required|date',
            'jam_mulai'     => 'required|date_format:H:i',
            'jam_selesai'   => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $user = Auth::user();

        // Ambil pengajuan aktif milik mahasiswa
        $pengajuan = \App\Models\Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

        // Cari log mingguan aktif berdasarkan tanggal
        $logMingguan = \App\Models\LogMingguan::where('pengajuan_id', $pengajuan->id)
            ->whereDate('tanggal_awal', '<=', $request->tanggal)
            ->whereDate('tanggal_akhir', '>=', $request->tanggal)
            ->first();

        if (!$logMingguan) {
            return redirect()->back()->with('error', 'Log mingguan belum dibuat untuk tanggal tersebut.');
        }

        // Simpan log harian
        \App\Models\LogHarian::create([
            'aktivitas'       => $request->aktivitas,
            'tanggal'         => $request->tanggal,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
            'log_mingguan_id' => $logMingguan->id,
        ]);

        return redirect()->route('mahasiswa.monitoring.index')->with('success', 'Log harian berhasil ditambahkan.');
    }
}
