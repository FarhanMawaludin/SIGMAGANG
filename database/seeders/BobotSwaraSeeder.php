<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotSwaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bobot untuk Pengalaman Kerja
        DB::table('bobot_swara')->insert([
            [
                'nama' => 'Tidak Ada Pengalaman',
                'nilai' => 0.1,
                'urutan_kriteria' => 'pengalaman_kerja_1',
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pengalaman Kurang dari 1 Tahun',
                'nilai' => 0.3,
                'urutan_kriteria' => 'pengalaman_kerja_2',
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pengalaman 1-2 Tahun',
                'nilai' => 0.5,
                'urutan_kriteria' => 'pengalaman_kerja_3',
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pengalaman 2-3 Tahun',
                'nilai' => 0.7,
                'urutan_kriteria' => 'pengalaman_kerja_4',
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pengalaman Lebih dari 3 Tahun',
                'nilai' => 0.9,
                'urutan_kriteria' => 'pengalaman_kerja_5',
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Bobot untuk Keterampilan
        DB::table('bobot_swara')->insert([
            [
                'nama' => 'Dasar',
                'nilai' => 0.2,
                'urutan_kriteria' => 'keterampilan_1',
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Baik',
                'nilai' => 0.4,
                'urutan_kriteria' => 'keterampilan_2',
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Sangat Baik',
                'nilai' => 0.6,
                'urutan_kriteria' => 'keterampilan_3',
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ahli',
                'nilai' => 0.8,
                'urutan_kriteria' => 'keterampilan_4',
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
