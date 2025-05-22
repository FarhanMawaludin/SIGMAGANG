<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;
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
            'no_telp' => 'nullable|string|max:20',
            'semester' => 'nullable|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user dan relasi mahasiswa
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
        // Jika ada foto baru, simpan dan update path-nya
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->mahasiswa->user->foto = $path;
            $user->mahasiswa->user->save();
            $user->mahasiswa->save();
        }
        $mahasiswa = $user->mahasiswa;
        $mahasiswa->no_telp = $validated['no_telp'];
        $mahasiswa->semester = $validated['semester'];
        $mahasiswa->save();

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
            'jenis_magang' => 'required|string|max:100',
            'kemampuan' => 'nullable|string|max:255',
            'file_cv' => 'nullable|file|mimes:pdf|max:2048',
            'file_transkrip' => 'nullable|file|mimes:pdf|max:2048',
            'file_sertifikat' => 'nullable|file|mimes:pdf|max:2048',
            'file_surat_pengantar' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'ipk' => $request->ipk,
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang' => $request->jenis_magang,
            'kemampuan' => $request->kemampuan,
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
        return view('mahasiswa.profil.edit-profil', [
            'user' => $user,
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
