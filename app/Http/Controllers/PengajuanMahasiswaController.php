<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengajuan;


class PengajuanMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $user = Auth::user();
        $category = $request->category ?? 'all';
        $mahasiswa = $user->mahasiswa;

        $query = Pengajuan::with(['mahasiswa.user', 'lowongan'])
            ->whereHas('mahasiswa', function ($q) {
                $q->where('user_id', auth()->id());
            });

        if ($search) {
            $query->whereHas('mahasiswa.user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($category !== 'all') {
            $query->where('status', $category);
        }

        $pengajuan = $query->paginate(10);

        return view('mahasiswa.pengajuan.index', [
            'activemenu' => 'pengajuan',
            'pengajuan' => $pengajuan,
            'mahasiswa' => $mahasiswa
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id',
        ]);

        $mahasiswa = auth()->user()->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        Pengajuan::create([
            'lowongan_id' => $request->lowongan_id,
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        return redirect()->route('mahasiswa.pengajuan.index')->with('success', 'Pengajuan berhasil dibuat');
    }
    
    public function show($id)
    {
        $pengajuan = Pengajuan::with(['mahasiswa.user', 'lowongan'])
            ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('mahasiswa.pengajuan.show', [
            'activemenu' => 'pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }
}
