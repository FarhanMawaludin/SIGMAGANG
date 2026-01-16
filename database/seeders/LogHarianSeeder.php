<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('log_harian')->insert([
            [
                'log_mingguan_id' => 1,
                'tanggal' => '2025-05-01',
                'aktivitas' => 'Mengikuti briefing program magang dan memahami SOP',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'log_mingguan_id' => 1,
                'tanggal' => '2025-05-02',
                'aktivitas' => 'Memulai pembuatan wireframe untuk proyek UI/UX',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'log_mingguan_id' => 2,
                'tanggal' => '2025-05-01',
                'aktivitas' => 'Mengikuti briefing program magang dan memahami SOP',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'log_mingguan_id' => 2,
                'tanggal' => '2025-05-02',
                'aktivitas' => 'Memulai pengembangan API backend untuk proyek',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
