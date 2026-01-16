<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periode')->insert([
            [
                'deskripsi' => 'Periode Magang Semester Ganjil 2025/2026',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-12-31',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'deskripsi' => 'Periode Magang Semester Genap 2025/2026',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-06-30',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
