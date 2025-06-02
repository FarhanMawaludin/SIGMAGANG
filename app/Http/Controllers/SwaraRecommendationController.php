<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Lowongan;
use Illuminate\Pagination\LengthAwarePaginator;

class SwaraRecommendationController extends Controller
{
    public function rekomendasi()
    {
        $activemenu = 'lowongan';

        $mahasiswa = Mahasiswa::with('skills', 'prodi')->where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.profil.index')
                ->with('error', 'Silakan lengkapi profil terlebih dahulu sebelum melihat rekomendasi.');
        }

        if (!$mahasiswa->isCompleteProfile()) {
            return redirect()->route('mahasiswa.profil.index')
                ->with('error', 'Profil Anda belum lengkap. Lengkapi profil terlebih dahulu.');
        }

        $bobot = [
            'skills' => 0.292,
            'ipk' => 0.243,
            'lokasi' => 0.187,
            'jenis_magang' => 0.134,
            'tipe_magang' => 0.089,
            'prodi' => 0.056,
        ];

        $lowongans = Lowongan::with('skills', 'prodi')->get();
        $hasil = [];

        foreach ($lowongans as $lowongan) {
            $nilai = [
                'skills' => $this->nilaiSkill($mahasiswa, $lowongan),
                'ipk' => $this->nilaiIpk($mahasiswa->ipk, $lowongan->ipk),
                'lokasi' => $mahasiswa->preferensi_lokasi === $lowongan->lokasi ? 1 : 0,
                'jenis_magang' => $mahasiswa->jenis_magang_id === $lowongan->jenis_magang_id ? 1 : 0,
                'tipe_magang' => $mahasiswa->tipe_magang === $lowongan->tipe_magang ? 1 : 0,
                'prodi' => optional($mahasiswa->prodi)->nama === optional($lowongan->prodi)->nama ? 1 : 0,
            ];

            $skor = collect($nilai)->map(fn($val, $k) => $val * $bobot[$k])->sum();

            $hasil[] = [
                'lowongan' => $lowongan,
                'nilai' => $nilai,
                'skor' => $skor,
            ];
        }

        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);

        // Pagination
        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;
        $itemsForCurrentPage = array_slice($hasil, $offset, $perPage);

        $hasilPaginated = new LengthAwarePaginator(
            $itemsForCurrentPage,
            count($hasil),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('mahasiswa.rekomendasi.index', [
            'activemenu' => $activemenu,
            'mahasiswa' => $mahasiswa,
            'hasil' => $hasilPaginated,
            'bobot' => $bobot,
        ]);
    }

    private function nilaiSkill($mahasiswa, $lowongan)
    {
        $mahasiswaSkillIds = $mahasiswa->skills->pluck('id')->toArray();
        $lowonganSkillIds = $lowongan->skills->pluck('id')->toArray();

        if (count($mahasiswaSkillIds) === 0) {
            return 0;
        }

        $cocok = array_intersect($mahasiswaSkillIds, $lowonganSkillIds);
        return count($cocok) / count($mahasiswaSkillIds);
    }

    private function nilaiIpk($ipkMahasiswa, $minIpkLowongan)
    {
        if (is_null($minIpkLowongan)) {
            return 0; 
        }

        return $ipkMahasiswa >= $minIpkLowongan ? 1 : 0;
    }
}
