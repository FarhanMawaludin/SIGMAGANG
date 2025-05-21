<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuan')->insert([
            [
                'mahasiswa_id' => 1,
                'lowongan_id' => 1,
                'status' => 'pending',
                'skor_spk' => 0,
                'mahasiswa_feedback' => null,
                'dosen_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 2,
                'lowongan_id' => 2,
                'status' => 'pending',
                'skor_spk' => 0,
                'dosen_id' => null,
                'mahasiswa_feedback' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 3,
                'lowongan_id' => 3,
                'status' => 'pending',
                'skor_spk' => 0,
                'dosen_id' => null,
                'mahasiswa_feedback' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
