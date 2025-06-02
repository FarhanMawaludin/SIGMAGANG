<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\LogMingguan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MonitoringMahasiswaController extends Controller
{
    public function index()
    {
        $activemenu = 'monitoring';
        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return view('mahasiswa.monitoring.index', compact('activemenu'))
                ->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $pengajuan = Pengajuan::with('mahasiswa.user')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', ['accepted', 'completed'])
            ->first();

        if (!$pengajuan) {
            $logMingguan = collect();
            return view('mahasiswa.monitoring.index', compact('activemenu', 'logMingguan', 'pengajuan'))
                ->with('error', 'Anda belum memiliki pengajuan yang disetujui.');
        }

        $logMingguan = LogMingguan::where('pengajuan_id', $pengajuan->id)
            ->orderByDesc('tanggal_awal')
            ->paginate(10);

        return view('mahasiswa.monitoring.index', compact('activemenu', 'logMingguan', 'pengajuan'));
    }


    public function create()
    {
        $activemenu = 'monitoring';
        $user = Auth::user();

        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        $lastMinggu = 0;
        $minTanggalAwal = null;
        $maxTanggalAkhir = null;

        if ($pengajuan) {
            $lastMinggu = LogMingguan::where('pengajuan_id', $pengajuan->id)->max('minggu') ?? 0;

            $lastLog = LogMingguan::where('pengajuan_id', $pengajuan->id)
                ->orderByDesc('minggu')
                ->first();

            if ($lastMinggu != 0 && $lastLog) {
                $minTanggalAwal = \Carbon\Carbon::parse($lastLog->tanggal_akhir)->addDay()->format('Y-m-d');
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

        $mahasiswa = $user->mahasiswa;

        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
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
    public function create_harian($id)
    {
        $activemenu = 'monitoring';
        $user = Auth::user();
        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();
        $logMingguan = LogMingguan::with('logHarian')->findOrFail($id);


        $minTanggalAwal = $logMingguan->tanggal_awal;
        $maxTanggalAkhir = $logMingguan->tanggal_akhir;

        return view('mahasiswa.monitoring.create_harian', compact('activemenu', 'logMingguan', 'minTanggalAwal', 'maxTanggalAkhir'));
    }


    public function store_harian(Request $request, $id)
    {

        $request->validate([
            'tanggal'      => 'required|date',
            'aktivitas'    => 'required|string',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i',
        ]);

        $jamMulai = Carbon::createFromFormat('Y-m-d H:i', $request->tanggal . ' ' . $request->jam_mulai);
        $jamSelesai = Carbon::createFromFormat('Y-m-d H:i', $request->tanggal . ' ' . $request->jam_selesai);

        if ($jamSelesai->lessThanOrEqualTo($jamMulai)) {
            return back()->withInput()->withErrors([
                'jam_selesai' => 'Jam selesai harus lebih dari jam mulai.'
            ]);
        }

        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
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

        // Validasi tanggal dalam rentang log mingguan
        if (
            $request->tanggal < $logMingguan->tanggal_awal ||
            $request->tanggal > $logMingguan->tanggal_akhir
        ) {
            return redirect()->back()->with('error', 'Tanggal log harian harus berada dalam rentang minggu yang dipilih.');
        }

        // Cek duplikasi log harian di tanggal yang sama
        $exists = LogHarian::where('log_mingguan_id', $logMingguan->id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Log harian untuk tanggal ini sudah ada.');
        }

        // Simpan data log harian
        LogHarian::create([
            'log_mingguan_id' => $logMingguan->id,
            'tanggal'         => $request->tanggal,
            'aktivitas'       => $request->aktivitas,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('mahasiswa.monitoring.show', $logMingguan->id)
            ->with('success', 'Log harian berhasil ditambahkan.');
    }

    public function edit_harian($mingguanId, $harianId)
    {
        $user = Auth::user();
        $activemenu = 'monitoring';

        // Cari pengajuan milik user login
        $pengajuan = Pengajuan::whereHas('mahasiswa', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'accepted')->firstOrFail();

        // Pastikan log mingguan milik pengajuan
        $logMingguan = LogMingguan::where('id', $mingguanId)
            ->where('pengajuan_id', $pengajuan->id)
            ->firstOrFail();

        // Pastikan log harian milik log mingguan tersebut
        $logHarian = LogHarian::where('id', $harianId)
            ->where('log_mingguan_id', $logMingguan->id)
            ->firstOrFail();

        return view('mahasiswa.monitoring.edit_harian', compact('activemenu', 'logMingguan', 'logHarian'));
    }


    public function update_harian(Request $request, $mingguan, $harian)
    {
        // Jika ada detik, potong supaya sesuai format H:i
        if ($request->jam_mulai) {
            $request->merge(['jam_mulai' => substr($request->jam_mulai, 0, 5)]);
        }
        if ($request->jam_selesai) {
            $request->merge(['jam_selesai' => substr($request->jam_selesai, 0, 5)]);
        }

        $request->validate([
            'tanggal'     => 'required|date',
            'aktivitas'   => 'required|string',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ], [
            'jam_mulai.date_format' => 'Format jam mulai harus berupa HH:mm (misal 08:30)',
            'jam_selesai.date_format' => 'Format jam selesai harus berupa HH:mm (misal 17:00)',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai',
        ]);

        $user = Auth::user();

        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

        $logHarian = LogHarian::findOrFail($harian);

        $logMingguan = LogMingguan::where('id', $logHarian->log_mingguan_id)
            ->where('pengajuan_id', $pengajuan->id)
            ->first();

        if (!$logMingguan) {
            return redirect()->back()->with('error', 'Log mingguan tidak ditemukan.');
        }

        // Cek tanggal masuk dalam rentang minggu
        if (
            $request->tanggal < $logMingguan->tanggal_awal ||
            $request->tanggal > $logMingguan->tanggal_akhir
        ) {
            return redirect()->back()->with('error', 'Tanggal log harian harus berada dalam rentang minggu yang dipilih.');
        }

        $logHarian->update([
            'tanggal'     => $request->tanggal,
            'aktivitas'   => $request->aktivitas,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('mahasiswa.monitoring.show', $logMingguan->id)
            ->with('success', 'Log harian berhasil diperbarui.');
    }


    public function detail_harian($mingguan, $harian)
    {
        $activemenu = 'monitoring';
        $user = Auth::user();
        $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
            ->where('status', 'accepted')
            ->first();
        $logMingguan = LogMingguan::with('logHarian')->findOrFail($mingguan);
        $logHarian = LogHarian::findOrFail($harian);

        return view('mahasiswa.monitoring.detail_harian', compact('activemenu', 'logMingguan', 'logHarian'));
    }
    public function selesai()
    {
        $user = Auth::user();
        // $pengajuan = Pengajuan::where('mahasiswa_id', $user->id)
        //     ->where('status', 'accepted')
        //     ->first();
        // if (!$pengajuan) {
        //     return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        // }

        // $pengajuan->update([
        //     'status' => 'completed',
        // ]);
        // return redirect()->route('mahasiswa.monitoring.index')->with('success', 'Log mingguan berhasil ditandai selesai.');

        return view('mahasiswa.monitoring.selesai', [
            'activemenu' => 'monitoring',
        ]);
    }

    public function updateSertifikatMagang(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $request->validate([
            'sertifikat_magang' => 'required|file|mimes:pdf|max:5120',
        ]);


        $dokumen = \App\Models\Dokumen::where('documentable_id', $mahasiswa->id)
            ->where('documentable_type', 'App\Models\Mahasiswa')
            ->where('tipe', 'Sertifikat Magang')
            ->first();

        if ($dokumen && $dokumen->file_path && \Storage::disk('public')->exists($dokumen->file_path)) {
            \Storage::disk('public')->delete($dokumen->file_path);
            $dokumen->delete();
        }


        $path = $request->file('sertifikat_magang')->store('dokumen', 'public');
        \App\Models\Dokumen::create([
            'documentable_id' => $mahasiswa->id,
            'documentable_type' => 'App\Models\Mahasiswa',
            'tipe' => 'Sertifikat Magang',
            'file_path' => $path,
        ]);

        return redirect()->route('mahasiswa.monitoring.index')->with('success', 'Surat Keterangan Magang berhasil diupload.');
    }
    public function review()
    {
        $activemenu = 'monitoring';
        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        $pengajuan = Pengajuan::with('mahasiswa.user')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'completed')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Anda belum memiliki pengajuan yang disetujui.');
        }

        return view('mahasiswa.monitoring.review', compact('activemenu', 'pengajuan'));
    }
    public function review_update(Request $request)
    {
        $request->validate([
            'mahasiswa_feedback' => 'required|string',
        ]);

        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'completed')
            ->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan Anda belum disetujui.');
        }

        $pengajuan->update([
            'mahasiswa_feedback' => $request->mahasiswa_feedback,
        ]);

        return redirect()->route('mahasiswa.monitoring.index')->with('success', 'Review berhasil ditambahkan.');
    }
    public function generateSuratKeterangan($pengajuan_id)
    {
        $pengajuan = \App\Models\Pengajuan::with(['mahasiswa.user', 'mahasiswa.prodi', 'dosen.user', 'lowongan.perusahaan'])
            ->findOrFail($pengajuan_id);

        $data = [
            'nomor_surat' => 'SKM/' . $pengajuan->id . '/' . date('Y'),
            'mahasiswa' => $pengajuan->mahasiswa,
            'dosen' => $pengajuan->dosen,
            'perusahaan' => $pengajuan->lowongan->perusahaan->nama,
            'tanggal_mulai' => $pengajuan->tanggal_mulai,
            'tanggal_selesai' => $pengajuan->tanggal_selesai,
        ];

        $pdf = Pdf::loadView('mahasiswa.monitoring.surat_magang', $data);
        return $pdf->download('Surat_Keterangan_Magang_' . $pengajuan->mahasiswa->nim . '.pdf');
    }
}
