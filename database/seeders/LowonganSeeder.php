<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lowongan')->insert([
            [
                'nama' => 'Magang UI/UX Designer',
                'deskripsi' => 'Bergabung bersama tim desain kami untuk mengembangkan pengalaman pengguna yang luar biasa.',
                'persyaratan' => 'Memiliki pengalaman dalam desain UI/UX, mampu menggunakan Figma atau Adobe XD, paham prinsip-prinsip UX.',
                'batas_pendaftaran' => '2025-05-31',
                'lokasi' => 'malang',
                'tipe_magang' => 'onsite',
                'jumlah_magang' => 2,
                'jenis_magang_id' => 1,
                'perusahaan_id' => 1,
                'periode_id' => 1,
                'prodi_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Magang Backend Developer',
                'deskripsi' => 'Bergabung bersama tim pengembangan untuk membangun sistem backend yang robust dan scalable.',
                'persyaratan' => 'Memiliki pengalaman dalam pemrograman PHP/Laravel, paham konsep REST API, mampu bekerja dengan database.',
                'batas_pendaftaran' => '2025-06-15',
                'lokasi' => 'malang',
                'tipe_magang' => 'onsite',
                'jenis_magang_id' => 1,
                'jumlah_magang' => 3,
                'perusahaan_id' => 1,
                'periode_id' => 1,
                'prodi_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Magang Data Analyst',
                'deskripsi' => 'Bergabung bersama tim analisis data kami untuk mengolah dan menginterpretasikan data bisnis.',
                'persyaratan' => 'Memiliki pengalaman dalam analisis data, mampu menggunakan SQL, Excel, dan tools analisis data lainnya.',
                'batas_pendaftaran' => '2025-06-30',
                'lokasi' => 'luar malang',
                'tipe_magang' => 'remote',
                'jumlah_magang' => 2,
                'jenis_magang_id' => 1,
                'perusahaan_id' => 2,
                'periode_id' => 1,
                'prodi_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
