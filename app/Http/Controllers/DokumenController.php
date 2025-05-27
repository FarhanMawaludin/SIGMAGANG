<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $dosen = $user->dosenPembimbing;

        // Cek apakah data mahasiswa tersedia
       if ($user->role === 'mahasiswa' && !$mahasiswa) {
    return redirect()->route('mahasiswa.profil.index')->with('error', 'Silakan lengkapi data informasi pribadi terlebih dahulu.');
}
if ($user->role === 'dosen_pembimbing' && !$dosen) {
    return redirect()->route('dosen.profil.index')->with('error', 'Silakan lengkapi data informasi pribadi terlebih dahulu.');
}

        // Tentukan model type berdasarkan role
        $documentableType = $user->role === 'mahasiswa'
            ? 'App\\Models\\Mahasiswa'
            : 'App\\Models\\DosenPembimbing';

        $documentableId = $user->role === 'mahasiswa'
            ? optional($user->mahasiswa)->id
            : optional($user->dosenPembimbing)->id;

        // Cek apakah data relasi tersedia
        if (!$documentableId) {
            return redirect()->route('mahasiswa.profil.index')->with('error', 'Silakan lengkapi data informasi pribadi terlebih dahulu.');
        }

        // Validasi file
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'transkrip' => 'nullable|file|mimes:pdf|max:5120',
            'pengantar' => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Upload CV
        if ($request->hasFile('cv')) {
            $this->replaceSingleDokumen($documentableId, $documentableType, 'CV', $request->file('cv'));
        }

        // Upload Transkrip
        if ($request->hasFile('transkrip')) {
            $this->replaceSingleDokumen($documentableId, $documentableType, 'Transkrip Nilai', $request->file('transkrip'));
        }

        // Upload Surat Pengantar
        if ($request->hasFile('pengantar')) {
            $this->replaceSingleDokumen($documentableId, $documentableType, 'Surat Pengantar', $request->file('pengantar'));
        }

        // Hitung sertifikat lama
        $sertifikatLama = Dokumen::where('documentable_id', $documentableId)
            ->where('documentable_type', $documentableType)
            ->where('tipe', 'Sertifikat')
            ->count();

        // Hitung sertifikat baru
        $sertifikatBaru = $request->file('sertifikat') ? count($request->file('sertifikat')) : 0;

        // Maksimum 3 sertifikat
        if (($sertifikatLama + $sertifikatBaru) > 3) {
            return back()->with('error', 'Maksimal 3 file sertifikat.');
        }

        // Upload sertifikat baru
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $file) {
                $path = $file->store('dokumen', 'public');

                Dokumen::create([
                    'documentable_id' => $documentableId,
                    'documentable_type' => $documentableType,
                    'tipe' => 'Sertifikat',
                    'file_path' => $path,
                ]);
            }
        }

        if ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.profil.index')->with('success', 'Dokumen berhasil diupdate.');
        } elseif ($user->role === 'dosen_pembimbing') {
        return redirect()->route('dosen.profil.index')->with('success', 'Dokumen berhasil diupdate.');
        } else {
        return back()->with('success', 'Dokumen berhasil diupdate.');
        }
    }

    /**
     * Mengganti dokumen tunggal (CV, Transkrip, Pengantar)
     */
    private function replaceSingleDokumen($documentableId, $documentableType, $tipe, $file)
    {
        // Cegah jika file kosong/null
        if (!$file || !$file->isValid()) {
            return;
        }

        $old = Dokumen::where('documentable_id', $documentableId)
            ->where('documentable_type', $documentableType)
            ->where('tipe', $tipe)
            ->first();

        if ($old && $old->file_path && Storage::disk('public')->exists($old->file_path)) {
            Storage::disk('public')->delete($old->file_path);
            $old->delete();
        }

        $path = $file->store('dokumen', 'public');

        Dokumen::create([
            'documentable_id' => $documentableId,
            'documentable_type' => $documentableType,
            'tipe' => $tipe,
            'file_path' => $path,
        ]);
    }
}
