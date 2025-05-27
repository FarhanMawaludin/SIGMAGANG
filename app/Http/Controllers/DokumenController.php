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
        // $dosen = $user->dosenPembimbing;

        // Cek apakah data mahasiswa tersedia
        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.profil.index')->with('error', 'Silakan lengkapi data informasi pribadi terlebih dahulu.');
        }

        // Cek apakah data dosen pembimbing tersedia
        // if ($dosen) {
        //     return redirect()->route('dosen.profil.index')->with('error', 'Silakan lengkapi data informasi pribadi terlebih dahulu.');
        // }

        // Tentukan model type berdasarkan role
        $documentableType = $user->role === 'mahasiswa'
            ? 'App\\Models\\Mahasiswa'
            : 'App\\Models\\Dosen';

        // Validasi file
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'transkrip' => 'nullable|file|mimes:pdf|max:5120',
            'pengantar' => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // CV
        if ($request->hasFile('cv')) {
            $this->replaceSingleDokumen($user, $documentableType, 'CV', $request->file('cv'));
        }

        // Transkrip
        if ($request->hasFile('transkrip')) {
            $this->replaceSingleDokumen($user, $documentableType, 'Transkrip Nilai', $request->file('transkrip'));
        }

        // Surat Pengantar
        if ($request->hasFile('pengantar')) {
            $this->replaceSingleDokumen($user, $documentableType, 'Surat Pengantar', $request->file('pengantar'));
        }

        // Sertifikat (max 3)
        $sertifikatLama = Dokumen::where('documentable_id', $user->id)
            ->where('documentable_type', $documentableType)
            ->where('tipe', 'Sertifikat')
            ->count();

        $sertifikatBaru = $request->file('sertifikat') ? count($request->file('sertifikat')) : 0;

        if (($sertifikatLama + $sertifikatBaru) > 3) {
            return back()->with('error', 'Maksimal 3 file sertifikat.');
        }

        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $file) {
                $path = $file->store('dokumen', 'public');

                Dokumen::create([
                    'documentable_id' => $user->id,
                    'documentable_type' => $documentableType,
                    'tipe' => 'Sertifikat',
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('mahasiswa.profil.index')->with('success', 'Dokumen berhasil diupdate.');
    }

    private function replaceSingleDokumen($user, $documentableType, $tipe, $file)
    {
        $old = Dokumen::where('documentable_id', $user->id)
            ->where('documentable_type', $documentableType)
            ->where('tipe', $tipe)
            ->first();

        if ($old && $old->file_path && Storage::disk('public')->exists($old->file_path)) {
            Storage::disk('public')->delete($old->file_path);
            $old->delete();
        }

        $path = $file->store('dokumen', 'public');

        Dokumen::create([
            'documentable_id' => $user->id,
            'documentable_type' => $documentableType,
            'tipe' => $tipe,
            'file_path' => $path,
        ]);
    }
}
