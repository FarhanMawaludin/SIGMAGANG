<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\JenisMagang;
use App\Models\Skill;
use App\Models\Prodi;
use App\Models\Pengajuan;

class LowonganMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'lowongan';

        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $query = Lowongan::with(['perusahaan', 'jenismagang', 'prodi'])
            ->withCount('pengajuan')
            ->where('jumlah_magang', '>', 0)
            ->where('batas_pendaftaran', '>=', now());

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all') {
            $query->where('perusahaan_id', $category);
        }

        $lowongan = $query->paginate(10)->appends([
            'search' => $search,
            'category' => $category,
        ]);

        $perusahaan = Perusahaan::all();
        $jenismagang = Jenismagang::all();
        $prodi = Prodi::all();

        $mahasiswa = auth()->user()->mahasiswa;
        $pengajuan = null;
        $profilLengkap = true;

        if ($mahasiswa) {
            $profilLengkap = $mahasiswa->isCompleteProfile();

            $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
                ->whereNotIn('status', ['rejected', 'completed'])
                ->latest()
                ->first();
        }

        return view('mahasiswa.lowongan.index', compact(
            'activemenu',
            'lowongan',
            'jenismagang',
            'prodi',
            'search',
            'category',
            'perusahaan',
            'pengajuan',
            'profilLengkap'
        ));
    }


    public function show($id)
    {
        $activemenu = 'lowongan';
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        // Cek apakah mahasiswa tersedia
        $pengajuan = $mahasiswa
            ? Pengajuan::where('mahasiswa_id', $mahasiswa->id)->first()
            : null;

        $lowongan = Lowongan::with(['perusahaan', 'jenismagang', 'skills'])
            ->withCount('pengajuan')
            ->findOrFail($id);

        $review = Pengajuan::where('lowongan_id', $id)
            ->where('status', 'completed')
            ->get();

        $profilLengkap = $mahasiswa?->isCompleteProfile() ?? false;

        return view('mahasiswa.lowongan.show', [
            'activemenu' => $activemenu,
            'lowongan' => $lowongan,
            'pengajuan' => $pengajuan,
            'review' => $review,
            'profilLengkap' => $profilLengkap,
        ]);
    }
}
