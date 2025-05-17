<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\JenisMagang;
use App\Models\Skill;
use App\Models\Prodi;

class LowonganMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'lowongan';

        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $query = Lowongan::with(['perusahaan','jenismagang','prodi'])->withCount('pengajuan');

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
            'category' => $category
        ]);

        $perusahaan = Perusahaan::all();
        $jenismagang = Jenismagang::all();
        $prodi = Prodi::all();
        return view('mahasiswa.lowongan.index', compact('activemenu', 'lowongan','jenismagang','prodi', 'search', 'category', 'perusahaan'));
    }

    public function show($id)
    {
        $activemenu = 'lowongan';
        $lowongan = Lowongan::with(['perusahaan','jenismagang','skill'])->withCount('pengajuan')->findOrFail($id);
        return view('mahasiswa.lowongan.show', [
            'activemenu' => $activemenu,
            'lowongan' => $lowongan,
        ]);
    }
}
