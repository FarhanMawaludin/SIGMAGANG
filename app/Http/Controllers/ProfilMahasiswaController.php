<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\JenisMagang;
use App\Models\Skill;

class ProfilMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa()->with(['prodi', 'jenismagang', 'skills'])->first();
        $activemenu = 'profil';

        return view('mahasiswa.profil.index', compact('user', 'mahasiswa', 'activemenu'));
    }

    // app/Models/User.php
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function updateInformasi(Request $request)
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

    public function updatePreferensi(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

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

        // Update ke tabel mahasiswa
        $data = [
            'ipk' => $request->ipk,
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang' => $request->jenis_magang,
            'kemampuan' => $request->kemampuan,
        ];

        foreach (['file_cv', 'file_transkrip', 'file_sertifikat', 'file_surat_pengantar'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField)->store('dokumen_magang', 'public');
                $data[$fileField] = $file;
            }
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.profil.index')->with('success', 'Preferensi magang berhasil diperbarui.');
    }
}
