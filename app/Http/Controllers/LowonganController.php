<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\Periode;
use App\Models\Prodi;
use App\Models\Skill;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'lowongan';

        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $query = Lowongan::with('perusahaan');

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

        $perusahaans = Perusahaan::all();
        return view('admin.lowongan.index', compact('activemenu', 'lowongan', 'search', 'category', 'perusahaans'));
    }

    public function create()
    {
        $activemenu = 'lowongan';
        $perusahaans = Perusahaan::all();
        $periodes = Periode::all();
        $prodis = Prodi::all();
        $skills = Skill::all();
        $jenismagang = JenisMagang::all();
        return view('admin.lowongan.create', compact('activemenu', 'perusahaans', 'periodes', 'prodis', 'skills', 'jenismagang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'batas_pendaftaran' => 'required|date',
            'lokasi' => 'required|string',
            'tipe_magang' => 'required',
            'jumlah_magang' => 'required|integer',
            'perusahaan_id' => 'required|exists:perusahaan,id',
            'periode_id' => 'nullable|integer',
            'prodi_id' => 'nullable|integer',
            'jenis_magang_id' => 'required|exists:jenis_magang,id',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'batas_pendaftaran.required' => 'Batas pendaftaran wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'jumlah_magang.required' => 'Jumlah magang wajib diisi.',
            'perusahaan_id.required' => 'Perusahaan wajib diisi.',
            'jenis_magang_id.required' => 'Jenis magang wajib diisi.',
        ]);
        try{

            $lowongan = Lowongan::create([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
                'persyaratan' => $validated['persyaratan'],
                'batas_pendaftaran' => $validated['batas_pendaftaran'],
                'lokasi' => $validated['lokasi'],
                'tipe_magang' => $validated['tipe_magang'],
                'jumlah_magang' => $validated['jumlah_magang'],
                'perusahaan_id' => $validated['perusahaan_id'],
                'periode_id' => $validated['periode_id'],
                'prodi_id' => $validated['prodi_id'],
                'jenis_magang_id' => $validated['jenis_magang_id'],
            ]);
            
            if ($request->has('skills')) {
                $lowongan->skills()->sync($request->skills);
            }
    
            return redirect()->route('admin.lowongan.index')->with('success', 'Data lowongan berhasil ditambahkan.');
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan lowongan.');
        }
    }

    public function show($id)
    {
        $activemenu = 'lowongan';
        $lowongan = Lowongan::with(['perusahaan','periode','prodi', 'jenismagang'])->findOrFail($id);
        $perusahaan = Perusahaan::all();
        $periode = Periode::all();
        $prodi = Prodi::all();
        $jenismagang = JenisMagang::all();
        return view('admin.lowongan.show', [
            'activemenu' => $activemenu,
            'lowongan' => $lowongan,
            'perusahaan' => $perusahaan,
            'periode' => $periode,
            'prodi' => $prodi,
            'jenismagang' => $jenismagang
        ]);
    }

    public function edit($id)
    {
        $activemenu = 'lowongan';
        $lowongan = Lowongan::with('skills')->findOrFail($id);
        $perusahaans = Perusahaan::all();
        $periodes = Periode::all();
        $prodis = Prodi::all();
        $skills = Skill::all();
        $jenismagang = JenisMagang::all();
        return view('admin.lowongan.edit', compact('activemenu', 'lowongan', 'perusahaans', 'periodes', 'prodis', 'skills', 'jenismagang'));
    }

    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'batas_pendaftaran' => 'required|date',
            'lokasi' => 'required|string',
            'tipe_magang' => 'required',
            'jumlah_magang' => 'required|integer',
            'perusahaan_id' => 'required|exists:perusahaan,id',
            'periode_id' => 'nullable|integer',
            'prodi_id' => 'nullable|integer',
            'jenis_magang_id' => 'required|exists:jenis_magang,id',
            'tipe_magang' => 'nullable|string',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'batas_pendaftaran.required' => 'Batas pendaftaran wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'tipe_magang.required' => 'Tipe magang wajib diisi.',
            'jumlah_magang.required' => 'Jumlah magang wajib diisi.',
            'perusahaan_id.required' => 'Perusahaan wajib diisi.',
            'tipe_magang.required' => 'Tipe magang wajib diisi.',
        ]);

        try{
            $lowongan->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'],
            'batas_pendaftaran' => $validated['batas_pendaftaran'],
            'lokasi' => $validated['lokasi'],
            'tipe_magang' => $validated['tipe_magang'],
            'jumlah_magang' => $validated['jumlah_magang'],
            'perusahaan_id' => $validated['perusahaan_id'],
            'periode_id' => $validated['periode_id'],
            'prodi_id' => $validated['prodi_id'],
            'jenis_magang_id' => $validated['jenis_magang_id'],
            'tipe_magang' => $validated['tipe_magang'],
        ]);

        // Sync skills if they exist in the request
        if ($request->has('skills')) {
            $lowongan->skills()->sync($request->skills);
        }

        return redirect()->route('admin.lowongan.index')->with('success', 'Data lowongan berhasil diperbarui.');
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate lowongan.');
        }
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('admin.lowongan.index')->with('success', 'Data lowongan berhasil dihapus.');
    }
    
}
