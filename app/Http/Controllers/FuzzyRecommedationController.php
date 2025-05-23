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

        $mahasiswa = Mahasiswa::with('skills')->where('user_id', Auth::id())->firstOrFail();

        $bobot = [
            'skills' => 0.25,
            'ipk' => 0.2,
            'lokasi' => 0.2,
            'jenis_magang' => 0.15,
            'tipe_magang' => 0.1,
            'prodi' => 0.1,
        ];

        $lowongans = Lowongan::with('skills')->get();
        $hasil = [];

        foreach ($lowongans as $lowongan) {
            $nilai = [
                'skills' => $this->nilaiSkill($mahasiswa, $lowongan),
                'ipk' => $this->nilaiIpk($mahasiswa->ipk, $lowongan->min_ipk),
                'lokasi' => $mahasiswa->preferensi_lokasi === $lowongan->lokasi ? 1 : 0,
                'jenis_magang' => $mahasiswa->jenis_magang === $lowongan->jenis_magang ? 1 : 0,
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
        ]);
    }

    private function nilaiIpk($ipkMahasiswa)
    {
        if (2.0 <= $ipkMahasiswa && $ipkMahasiswa <= 2.75) {
            return 0.25;
        } elseif (2.75 <= $ipkMahasiswa && $ipkMahasiswa <= 3.25) {
            return 0.5;
        } else if (3.25 <= $ipkMahasiswa && $ipkMahasiswa <= 4.0) {
            return 1;
        } else {
            return 0;
        }
    }
     private function nilaiSkill($mahasiswa, $lowongan)
    {
        $mahasiswaSkillIds = $mahasiswa->skills->pluck('id')->toArray();
        $lowonganSkillIds = $lowongan->skills->pluck('id')->toArray();

        if (count($mahasiswaSkillIds) === 0) {
            return 0;
        }

        $cocok = array_intersect($mahasiswaSkillIds, $lowonganSkillIds);
        if (count($cocok) == 1) {
            return 0.25;
        } elseif (count($cocok) == 2) {
            return 0.5;
        } elseif (count($cocok) >= 3) {
                return 1;
        } else {
            return 0;
        }
    }
}
