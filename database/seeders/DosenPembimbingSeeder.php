<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenPembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen_pembimbing')->insert([
            [
                'nidn' => '197001011995011001',
                'no_telp' => '081234567890',
                'jabatan' => 'lektor',
                'user_id' => 4,
                'prodi_id' => 1,
                'preferensi_lokasi' => 'malang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
