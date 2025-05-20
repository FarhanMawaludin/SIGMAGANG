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

        $pengajuan = Pengajuan::with('mahasiswa.user')
            ->where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            $logMingguan = collect();
            return view('mahasiswa.monitoring.index', compact('activemenu', 'logMingguan'))
            ->with('error', 'Anda belum memiliki pengajuan yang disetujui.');
        }

        $logMingguan = LogMingguan::where('pengajuan_id', $pengajuan->id)
            ->orderByDesc('tanggal_awal')
            ->paginate(10);

        return view('mahasiswa.monitoring.index', compact('activemenu', 'logMingguan'));
    }

   public function create()
{
    $activemenu = 'monitoring';
    $user = auth()->user();
    $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
        ->where('status', 'accepted')
        ->first();

    $lastMinggu = 0;
    if ($pengajuan) {
        $lastMinggu = LogMingguan::where('pengajuan_id', $pengajuan->id)->max('minggu') ?? 0;
        $lastLog = LogMingguan::where('pengajuan_id', $pengajuan->id)
            ->orderByDesc('minggu')
            ->first();
            if($lastMinggu == 0){
                $minTanggalAwal = null;
                $maxTanggalAkhir = null;
            }else{
        $minTanggalAwal = $lastLog ? \Carbon\Carbon::parse($lastLog->tanggal_akhir)->addDay()->format('Y-m-d') : null;
        $maxTanggalAkhir = \Carbon\Carbon::parse($lastLog->tanggal_akhir)->addDays(6)->format('Y-m-d');
            }
    }

    return view('mahasiswa.monitoring.create', [
        'activemenu' => $activemenu,
        'nextMinggu' => $lastMinggu + 1,
        'minTanggalAwal' => $minTanggalAwal,
        'maxTanggalAkhir' => $maxTanggalAkhir,
    ]);
}
    

    public function store(Request $request)
    {
        $request->validate([
            'minggu'         => 'required|integer|min:1',
            'tanggal_awal'   => 'required|date',
            'tanggal_akhir'  => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $user = Auth::user();

        // Ambil pengajuan aktif milik mahasiswa
        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

     
        $exists = LogMingguan::where('pengajuan_id', $pengajuan->id)
            ->where('minggu', $request->minggu)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Log mingguan untuk minggu ini sudah ada.');
        }

        
      LogMingguan::create([
            'pengajuan_id'   => $pengajuan->id,
            'minggu'         => $request->minggu,
            'tanggal_awal'   => $request->tanggal_awal,
            'tanggal_akhir'  => $request->tanggal_akhir,
        ]);

        return redirect()->route('mahasiswa.monitoring.index')->with('success', 'Log harian berhasil ditambahkan.');
    }
    public function show($id)
    {
        $activemenu = 'monitoring';
        $logMingguan = LogMingguan::with('logHarian')->findOrFail($id);

        return view('mahasiswa.monitoring.show', compact('activemenu', 'logMingguan'));
    }
    public function create_harian($id){
        $activemenu = 'monitoring';
    $user = Auth::user();   
    $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
        ->where('status', 'accepted')
        ->first();
    $logMingguan = LogMingguan::with('logHarian')->findOrFail($id);

  
    $minTanggalAwal = $logMingguan->tanggal_awal;
    $maxTanggalAkhir = $logMingguan->tanggal_akhir;

    return view('mahasiswa.monitoring.create_harian', compact('activemenu', 'logMingguan','minTanggalAwal','maxTanggalAkhir'));
    }
    public function store_harian(Request $request,$id){
        $request->validate([
            'tanggal'      => 'required|date',
            'aktivitas'     => 'required|string',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $user = Auth::user();

        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

        $logMingguan = LogMingguan::where('id', $id)
            ->where('pengajuan_id', $pengajuan->id)
            ->first();

        if (!$logMingguan) {
            return redirect()->back()->with('error', 'Log mingguan tidak ditemukan.');
        }

        if (
            $request->tanggal < $logMingguan->tanggal_awal ||
            $request->tanggal > $logMingguan->tanggal_akhir
        ) {
            return redirect()->back()->with('error', 'Tanggal log harian harus berada dalam rentang minggu yang dipilih.');
        }

        $exists = LogHarian::where('log_mingguan_id', $logMingguan->id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Log harian untuk tanggal ini sudah ada.');
        }

        LogHarian::create([
            'log_mingguan_id' => $logMingguan->id,
            'tanggal'         => $request->tanggal,
            'aktivitas'        => $request->aktivitas,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('mahasiswa.monitoring.show', $logMingguan->id)
            ->with('success', 'Log harian berhasil ditambahkan.');
    }
    public function edit_harian($id){
        $activemenu = 'monitoring';
        $user = Auth::user();   
        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();
        $logHarian = LogHarian::findOrFail($id);
        $logMingguan = LogMingguan::with('logHarian')->findOrFail($logHarian->log_mingguan_id);

        return view('mahasiswa.monitoring.edit_harian', compact('activemenu', 'logMingguan','logHarian'));
    }
    public function update_harian(Request $request, $id)
    {
        $request->validate([
            'tanggal'      => 'required|date',
            'aktivitas'     => 'required|string',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $user = Auth::user();

        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

        $logHarian = LogHarian::findOrFail($id);
        $logMingguan = LogMingguan::where('id', $logHarian->log_mingguan_id)
            ->where('pengajuan_id', $pengajuan->id)
            ->first();

        if (!$logMingguan) {
            return redirect()->back()->with('error', 'Log mingguan tidak ditemukan.');
        }

        if (
            $request->tanggal < $logMingguan->tanggal_awal ||
            $request->tanggal > $logMingguan->tanggal_akhir
        ) {
            return redirect()->back()->with('error', 'Tanggal log harian harus berada dalam rentang minggu yang dipilih.');
        }

        $logHarian->update([
            'tanggal'         => $request->tanggal,
            'aktivitas'       => $request->aktivitas,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('mahasiswa.monitoring.show', $logMingguan->id)
            ->with('success', 'Log harian berhasil diperbarui.');
    }
    public function detail_harian($mingguan,$harian){
        $activemenu = 'monitoring';
        $user = Auth::user();   
        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();
        $logMingguan = LogMingguan::with('logHarian')->findOrFail($mingguan);
        $logHarian = LogHarian::findOrFail($harian);

        return view('mahasiswa.monitoring.detail_harian', compact('activemenu', 'logMingguan','logHarian'));
    }
}
