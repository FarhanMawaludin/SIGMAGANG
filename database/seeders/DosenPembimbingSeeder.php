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
                'user_id' => 1,
                'prodi_id' => 1,
                'preferensi_lokasi' => 'malang',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nidn' => '197503151998032002',
                'no_telp' => '081234567891',
                'jabatan' => 'asisten_ahli',
                'user_id' => 2,
                'prodi_id' => 2,
                'preferensi_lokasi' => 'malang',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nidn' => '197206201996061003',
                'no_telp' => '081234567892',
                'jabatan' => 'asisten_ahli',
                'user_id' => 3,
                'prodi_id' => 2,
                'preferensi_lokasi' => 'malang',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
