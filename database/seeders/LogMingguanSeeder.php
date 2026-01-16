<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogMingguanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('log_mingguan')->insert([
            [
                'pengajuan_id' => 1,
                'minggu' => 1,
                'tanggal_awal' => '2025-05-01',
                'tanggal_akhir' => '2025-05-07',
                'dosen_feedback' => 'Bagus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pengajuan_id' => 2,
                'minggu' => 1,
                'tanggal_awal' => '2025-05-01',
                'tanggal_akhir' => '2025-05-07',
                'dosen_feedback' => 'Bagus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pengajuan_id' => 3,
                'minggu' => 1,
                'tanggal_awal' => '2025-05-01',
                'tanggal_akhir' => '2025-05-07',
                'dosen_feedback' => 'Bagus',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
