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
        // Validasi file
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'transkrip' => 'nullable|file|mimes:pdf|max:5120',
            'pengantar' => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // CV
        if ($request->hasFile('cv')) {
            $this->replaceSingleDokumen($user, 'CV', $request->file('cv'));
        }
        // Transkrip
        if ($request->hasFile('transkrip')) {
            $this->replaceSingleDokumen($user, 'Transkrip Nilai', $request->file('transkrip'));
        }
        // Surat Pengantar
        if ($request->hasFile('pengantar')) {
            $this->replaceSingleDokumen($user, 'Surat Pengantar', $request->file('pengantar'));
        }
        // Sertifikat (bisa banyak, max 3)
        $sertifikat_lama = Dokumen::where('documentable_id', $user->id)->where('tipe', 'Sertifikat')->count();
        $sertifikat_baru = $request->file('sertifikat') ? count($request->file('sertifikat')) : 0;
        if (($sertifikat_lama + $sertifikat_baru) > 3) {
            return back()->with('error', 'Maksimal 3 file sertifikat.');
        }
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $file) {
                $path = $file->store('dokumen', 'public');
                Dokumen::create([
                    'documentable_id' => $user->id,
                    'documentable_type' => $user->role === 'mahasiswa' ? 'mahasiswa' : 'dosen',
                    'tipe' => 'Sertifikat',
                    'file_path' => $path,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Dokumen berhasil diupdate.');
    }

    private function replaceSingleDokumen($user, $tipe, $file)
    {
        $old = Dokumen::where('documentable_id', $user->id)
            ->where('documentable_type', $user->role === 'mahasiswa' ? 'mahasiswa' : 'dosen')
            ->where('tipe', $tipe)
            ->first();
        if ($old && $old->file_path && Storage::disk('public')->exists($old->file_path)) {
            Storage::disk('public')->delete($old->file_path);
            $old->delete();
        }
        $path = $file->store('dokumen', 'public');
        Dokumen::create([
            'documentable_id' => $user->id,
            'documentable_type' => $user->role === 'mahasiswa' ? 'mahasiswa' : 'dosen',
            'tipe' => $tipe,
            'file_path' => $path,
        ]);
    }
}