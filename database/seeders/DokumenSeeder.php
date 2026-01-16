<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokumen')->insert([
            [
                'documentable_id' => 1,
                'documentable_type' => 'App\Models\Mahasiswa',
                'tipe' => 'CV',
                'file_path' => 'path/to/file.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'documentable_id' => 1,
                'documentable_type' => 'App\Models\Mahasiswa',
                'tipe' => 'Transkrip Nilai',
                'file_path' => 'path/to/file.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'documentable_id' => 1,
                'documentable_type' => 'App\Models\Mahasiswa',
                'tipe' => 'Sertifikat',
                'file_path' => 'path/to/file.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'documentable_id' => 1,
                'documentable_type' => 'App\Models\Mahasiswa',
                'tipe' => 'Surat Pengantar',
                'file_path' => 'path/to/file.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
