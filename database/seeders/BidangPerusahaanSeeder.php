<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bidang_perusahaan')->insert([
            [
                'nama_bidang' => 'Teknologi Informasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Software Development',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Cyber Security',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Data Science',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
