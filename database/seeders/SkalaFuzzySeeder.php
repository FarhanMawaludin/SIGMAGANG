<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkalaFuzzySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skala Fuzzy untuk Pengalaman Kerja
        DB::table('skala_fuzzy')->insert([
            [
                'nama_skala' => 'Rendah',
                'nilai_min' => 0,
                'nilai_max' => 0.3,
                'nilai_mid' => 0.15,
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_skala' => 'Sedang',
                'nilai_min' => 0.2,
                'nilai_max' => 0.6,
                'nilai_mid' => 0.4,
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_skala' => 'Tinggi',
                'nilai_min' => 0.5,
                'nilai_max' => 1,
                'nilai_mid' => 0.75,
                'criteria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Skala Fuzzy untuk Keterampilan
        DB::table('skala_fuzzy')->insert([
            [
                'nama_skala' => 'Dasar',
                'nilai_min' => 0,
                'nilai_max' => 0.4,
                'nilai_mid' => 0.2,
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_skala' => 'Baik',
                'nilai_min' => 0.3,
                'nilai_max' => 0.7,
                'nilai_mid' => 0.5,
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_skala' => 'Ahli',
                'nilai_min' => 0.6,
                'nilai_max' => 1,
                'nilai_mid' => 0.8,
                'criteria_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
