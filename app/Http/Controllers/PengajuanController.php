<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\Dokumen;
use App\Models\Lowongan;
use Illuminate\Support\Facades\DB;
class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'pengajuan';
        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $pengajuanAll = Pengajuan::all();

        $query = Pengajuan::with(['mahasiswa.user', 'mahasiswa.prodi', 'lowongan']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa.user', function ($q1) use ($search) {
                    $q1->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('mahasiswa.prodi', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%");
                    })
                    ->orWhereHas('lowongan', function ($q3) use ($search) {
                        $q3->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($category !== 'all') {
            $query->where('status', $category);
        }
        $pengajuan = $query->paginate(10);
        $pengajuan->appends(['search' => $search, 'category' => $category]);

        return view('admin.pengajuan.index', [
            'activemenu' => $activemenu,
            'pengajuanAll' => $pengajuanAll,
            'pengajuan' => $pengajuan,
            'category' => $category,
            'search' => $search,
        ]);
    }
    public function edit($id)
{
    $activemenu = 'pengajuan';
    $dosens = DosenPembimbing::all();
    $pengajuan = Pengajuan::with(['mahasiswa.user', 'mahasiswa.prodi', 'lowongan'])->findOrFail($id);

    // Ambil semua dokumen mahasiswa terkait pengajuan ini
    $dokumen_all = Dokumen::where('documentable_type', 'App\Models\Mahasiswa')
        ->where('documentable_id', $pengajuan->mahasiswa_id)
        ->get();
        
    $dokumen_cv = $dokumen_all->where('tipe', 'CV')->first();
    $dokumen_surat_keterangan_magang = $dokumen_all->where('tipe', 'Sertifikat Magang')->first();
    $dokumen_transkrip = $dokumen_all->where('tipe', 'Transkrip Nilai')->first();
    $dokumen_pengantar = $dokumen_all->where('tipe', 'Surat Pengantar')->first();
    $dokumen_sertifikat = $dokumen_all->where('tipe', 'Sertifikat')->values();


    return view('admin.pengajuan.edit', [
        'pengajuan' => $pengajuan,
        'activemenu' => $activemenu,
        'dosens' => $dosens,
        'dokumen_cv' => $dokumen_cv,
        'dokumen_transkrip' => $dokumen_transkrip,
        'dokumen_pengantar' => $dokumen_pengantar,
        'dokumen_sertifikat' => $dokumen_sertifikat,
        'dokumen_surat_keterangan_magang' => $dokumen_surat_keterangan_magang,
    ]);
}
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required',
           
        ],[
            'dosen_id.required' => 'Dosen wajib diisi.',

        ]);
        try{
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'dosen_id' => $request->dosen_id,
        ]);
        return redirect()->route('admin.pengajuan.index')->with('success', 'Status berhasil diubah');
    }catch(\Exception $e){
        return redirect()->back()->withInput()->with('error', 'Gagal mengubah status.');
    }
    }

public function update(Request $request, $id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    $request->validate([
        'action' => 'required|in:accept,decline,done',
        'catatan_validasi' => 'nullable|string',
    ]);
    if ($request->filled('dosen_id')) {
        $pengajuan->dosen_id = $request->dosen_id;
    }
    $pengajuan->catatan_validasi = $request->catatan_validasi;
    if ($request->action === 'accept') {
        $pengajuan->status = 'accepted';
    } elseif ($request->action === 'decline') {
        $pengajuan->status = 'rejected';
    } elseif ($request->action === 'done') {
        $pengajuan->status = 'completed';
    }

    $pengajuan->save();
     if ($request->action === 'accept') {
        Lowongan::where('id', $pengajuan->lowongan_id)->update([
            'jumlah_magang' => DB::raw('jumlah_magang - 1')
        ]);
    }

    return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan berhasil diproses.');
}
}