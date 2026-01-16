<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_magang')->insert([
            [
                'jenis_magang' => 'Magang Industri',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jenis_magang' => 'Magang Riset',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jenis_magang' => 'Magang Kewirausahaan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jenis_magang' => 'Magang Pemerintahan',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
