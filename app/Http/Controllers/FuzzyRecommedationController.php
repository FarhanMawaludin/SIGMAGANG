<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Lowongan;
use Illuminate\Pagination\LengthAwarePaginator;


class FuzzyRecommedationController extends Controller
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
            'skills' => 0.27,
            'ipk' => 0.21,
            'lokasi' => 0.18,
            'jenis_magang' => 0.14,
            'tipe_magang' => 0.11,
            'prodi' => 0.09,
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
                'prodi' => $mahasiswa->prodi->nama === $lowongan->prodi->nama ? 1 : 0,
            ];

            $skor = collect($nilai)->map(fn($val, $k) => $val * $bobot[$k])->sum();

            $hasil[] = [
                'lowongan' => $lowongan,
                'nilai' => $nilai,
                'skor' => $skor,
            ];
        }

        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);

        $top3 = array_slice($hasil, 0, 3);

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

        return view('mahasiswa.rekomendasi.fuzzy', [
            'activemenu' => $activemenu,
            'mahasiswa' => $mahasiswa,
            'hasil' => $hasilPaginated,
            'bobot' => $bobot,
            'top3' => $top3
        ]);
    }

    private function nilaiIpk($ipkMahasiswa, $ipkLowongan)
    {
        if ($ipkLowongan === null || $ipkMahasiswa < $ipkLowongan) {
            return 0;
        }

        $rendah = 0;
        $sedang = 0;
        $tinggi = 0;

        if ($ipkMahasiswa <= 2.0) {
            $rendah = 1;
        } elseif ($ipkMahasiswa > 2.0 && $ipkMahasiswa < 2.75) {
            $rendah = (2.75 - $ipkMahasiswa) / (2.75 - 2.0);
            $sedang = ($ipkMahasiswa - 2.0) / (2.75 - 2.0);
        } elseif ($ipkMahasiswa == 2.75) {
            $sedang = 1;
        } elseif ($ipkMahasiswa > 2.75 && $ipkMahasiswa < 3.25) {
            $sedang = (3.25 - $ipkMahasiswa) / (3.25 - 2.75);
            $tinggi = ($ipkMahasiswa - 2.75) / (3.25 - 2.75);
        } elseif ($ipkMahasiswa >= 3.25 && $ipkMahasiswa <= 4.0) {
            $tinggi = 1;
        }

        // Nilai rata-rata (a+b+c)/3 dari masing-masing segitiga
        $nilaiRendah = (0 + 2.0 + 2.75) / 3;     // 1.583
        $nilaiSedang = (2.0 + 2.75 + 3.25) / 3;  // 2.667
        $nilaiTinggi = (2.75 + 3.25 + 4.0) / 3;  // 3.333

        // Defuzzifikasi: total fuzzy value dibagi total derajat
        $numerator = ($rendah * $nilaiRendah) + ($sedang * $nilaiSedang) + ($tinggi * $nilaiTinggi);
        $denominator = $rendah + $sedang + $tinggi;

        $skor = $denominator > 0 ? $numerator / $denominator : 0;

        return round($skor, 3);
    }




    private function nilaiSkill($mahasiswa, $lowongan)
    {
        $mahasiswaSkillIds = $mahasiswa->skills->pluck('id')->toArray();
        $lowonganSkillIds = $lowongan->skills->pluck('id')->toArray();

        if (count($mahasiswaSkillIds) === 0) {
            return 0;
        }

        $jumlahCocok = count(array_intersect($mahasiswaSkillIds, $lowonganSkillIds));

        // Inisialisasi derajat keanggotaan
        $rendah = 0;
        $sedang = 0;
        $tinggi = 0;

        // Fuzzifikasi segitiga berbasis nilai integer
        if ($jumlahCocok == 0 || $jumlahCocok == 1) {
            $rendah = 1;
        } elseif ($jumlahCocok == 2) {
            $sedang = 1;
        } elseif ($jumlahCocok >= 3) {
            $tinggi = 1;
        }

        // Nilai centroid (a + b + c) / 3 untuk tiap segitiga
        $nilaiRendah = 1.0;   // (0 + 1 + 2) / 3
        $nilaiSedang = 2.0;   // (1 + 2 + 3) / 3
        $nilaiTinggi = 3.33;  // (2 + 3 + 5) / 3

        // Defuzzifikasi
        $numerator = ($rendah * $nilaiRendah) + ($sedang * $nilaiSedang) + ($tinggi * $nilaiTinggi);
        $denominator = $rendah + $sedang + $tinggi;

        $skor = $denominator > 0 ? $numerator / $denominator : 0;

        return round($skor, 3);
    }
}
