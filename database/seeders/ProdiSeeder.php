<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            [
                'nama' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Sistem Informasi Bisnis',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
