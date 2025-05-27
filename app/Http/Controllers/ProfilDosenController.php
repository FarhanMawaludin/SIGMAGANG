<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DosenPembimbing;
use App\Models\Skill;
use App\Models\JenisMagang;
use App\Models\Prodi;

class ProfilDosenController extends Controller
{
    public function index()
    {
        
        $user = Auth::user();
        $dosen = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        $allSkills = Skill::all();

        return view('dosen.profil.index', [
            'user' => $user,
            'dosen_pembimbing' => $dosen,
            'allSkills' => $allSkills,
            'activemenu' => 'profil',
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $prodis = Prodi::all();
        return view('dosen.profil.edit-profil', [
            'user' => $user,
            'prodis' => $prodis,
            'dosen_pembimbing' => $user->dosen,
            'activemenu' => 'profil',
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'nullable|string|max:20',
            'nidn' => 'required|string|max:255',
        ]);

        // Update ke tabel users
        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        // Update ke tabel dosen_pembimbing
        $dosen->update([
            'no_telp' => $request->no_telp,
            'nidn' => $request->nidn,
        ]);

        return redirect()->route('dosen.profil.index')->with('success', 'Informasi pribadi berhasil diperbarui.');
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'nidn' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prodi_id' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah digunakan sebelumnya.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'nidn.required' => 'NIDN wajib diisi.',
            'prodi_id.required' => 'Prodi wajib diisi.',
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Cek relasi mahasiswa
        $dosen = $user->dosenPembimbing;

        if (!$dosen) {
            // Jika belum ada, buat data mahasiswa baru
            $dosen = new \App\Models\DosenPembimbing();
            $dosen->user_id = $user->id;
        }

        // Update/isi data mahasiswa
        $dosen->no_telp = $validated['no_telp'];
        $dosen->nidn = $validated['nidn'];
        $dosen->jabatan = $request->jabatan;
        $dosen->prodi_id = $request->prodi_id;
        
        $dosen->save();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
            $user->save(); // Simpan ke kolom foto user
        }

        return redirect()->route('dosen.profil.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function edit_preferensi()
    {
        $activemenu = 'profil';
        $user = Auth::user();
        $dosen = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        $jenismagang = JenisMagang::all();
        $skills = Skill::all(); 

        return view('dosen.profil.edit_preferensi', [
            'activemenu' => $activemenu,
            'user' => $user,
            'dosen' => $dosen,
            'skills' => $skills,
            'jenismagang' => $jenismagang
        ]);
    }

    public function updatePreferensi(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

        $request->validate([
            'preferensi_lokasi' => 'required|string|max:100',
            'jenis_magang_id' => 'required|exists:jenis_magang,id',
            'skills' => 'nullable|array',
        ]);

        $data = [
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang_id' => $request->jenis_magang_id,

        ];
         if ($request->has('skills')) {
            $dosen->skills()->sync($request->skills);
        }

        // Proses upload file
        foreach (['file_cv', 'file_transkrip', 'file_sertifikat', 'file_surat_pengantar'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField)->store('dokumen_magang', 'public');
                $data[$fileField] = $file;
            }
        }
        $dosen->update($data);

        return redirect()->route('dosen.profil.index')->with('success', 'Preferensi magang berhasil diperbarui.');
    }
}
