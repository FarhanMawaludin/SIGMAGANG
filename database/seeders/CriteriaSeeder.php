<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criteria')->insert([
            [
                'nama' => 'Pengalaman Kerja',
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Keterampilan',
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Prestasi Akademik',
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Absensi',
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kepatuhan',
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
