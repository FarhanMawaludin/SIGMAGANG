<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;
use App\Models\Prodi;
use App\Models\JenisMagang;
use App\Models\Mahasiswa;

class ProfilMahasiswaController extends Controller
{
    /**
     * Tampilkan halaman profil mahasiswa
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa()->with(['prodi', 'jenismagang', 'skills'])->first();
        $allSkills = Skill::all();

        return view('mahasiswa.profil.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'allSkills' => $allSkills,
            'activemenu' => 'profil',
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'nullable|string|max:20',
            'semester' => 'required|integer',
        ]);

        // Update ke tabel users
        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        // Update ke tabel mahasiswa
        $mahasiswa->update([
            'no_telp' => $request->no_telp,
            'semester' => $request->semester,
            'nim' => $request->nim
        ]);

        return redirect()->route('mahasiswa.profil.index')->with('success', 'Informasi pribadi berhasil diperbarui.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'semester' => 'required|integer|min:1',
            'nim' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah digunakan sebelumnya.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Cek relasi mahasiswa
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            // Jika belum ada, buat data mahasiswa baru
            $mahasiswa = new \App\Models\Mahasiswa();
            $mahasiswa->user_id = $user->id;
        }

        // Update/isi data mahasiswa
        $mahasiswa->no_telp = $validated['no_telp'];
        $mahasiswa->semester = $validated['semester'];
        $mahasiswa->nim = $validated['nim'];
        $mahasiswa->prodi_id = $request->prodi_id;
        $mahasiswa->save();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
            $user->save(); // Simpan ke kolom foto user
        }

        return redirect()->route('mahasiswa.profil.index')->with('success', 'Profil berhasil diperbarui');
    }


    /**
     * Update preferensi magang mahasiswa
     */
    public function updatePreferensi(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::findOrFail($user->mahasiswa->id);

        $request->validate([
            'ipk' => 'required|numeric|between:0,4.00',
            'preferensi_lokasi' => 'required|string|max:100',
            'jenis_magang_id' => 'required|exists:jenis_magang,id',
            'tipe_magang' => 'required|in:onsite,remote',
            'kemampuan' => 'nullable|string|max:255',
            'file_cv' => 'nullable|file|mimes:pdf|max:2048',
            'file_transkrip' => 'nullable|file|mimes:pdf|max:2048',
            'file_sertifikat' => 'nullable|file|mimes:pdf|max:2048',
            'file_surat_pengantar' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'ipk' => $request->ipk,
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang_id' => $request->jenis_magang_id,
            'kemampuan' => $request->kemampuan,
            'tipe_magang' => $request->tipe_magang
        ];

        // Proses upload file
        foreach (['file_cv', 'file_transkrip', 'file_sertifikat', 'file_surat_pengantar'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField)->store('dokumen_magang', 'public');
                $data[$fileField] = $file;
            }
        }
        if ($request->has('skills')) {
            $mahasiswa->skills()->sync($request->skills);
        }
        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.profil.index')->with('success', 'Preferensi magang berhasil diperbarui.');
    }

    /**
     * Form edit data pribadi
     */
    public function edit()
    {
        $user = Auth::user();
        $prodis = Prodi::all();
        return view('mahasiswa.profil.edit-profil', [
            'user' => $user,
            'prodis' => $prodis,
            'activemenu' => 'profil',
        ]);
    }

    /**
     * Form edit preferensi magang
     */
    public function editPreferensi($id)
    {
        $user = Auth::user();
        $jenismagang = JenisMagang::all();
        $mahasiswa = Mahasiswa::with('skills')->findOrFail($id);
        $allSkills = Skill::all();
        return view('mahasiswa.profil.edit-preferensi', [
            'user' => $user,
            'jenismagang' => $jenismagang,
            'mahasiswa' => $mahasiswa,
            'skills' => $allSkills,
            'activemenu' => 'profil',
        ]);
    }
}
