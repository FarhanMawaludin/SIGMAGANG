<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaan')->insert([
            [
                'nama' => 'PT Sigma Tech Indonesia',
                'alamat' => 'Jl. Raya Malang No. 123, Malang',
                'email' => 'hrd@sigmatech.com',
                'deskripsi' => 'Perusahaan teknologi terkemuka di Indonesia yang berfokus pada pengembangan software dan solusi digital.',
                'bidang_perusahaan_id' => 1,
                'no_telp' => '08123456789',
                'website' => 'https://sigmatech.com',
                'foto' => 'logo-sigmattech.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'PT Digital Solution',
                'alamat' => 'Jl. Sukarno Hatta No. 456, Malang',
                'email' => 'recruitment@digitalsolution.com',
                'deskripsi' => 'Perusahaan yang menyediakan solusi digital untuk berbagai industri.',
                'bidang_perusahaan_id' => 2,
                'no_telp' => '08123456789',
                'website' => 'https://digitalsolution.com',
                'foto' => 'logo-digitalsolution.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'PT Cyber Security',
                'alamat' => 'Jl. Ahmad Yani No. 789, Malang',
                'email' => 'hr@cybersecurity.com',
                'deskripsi' => 'Perusahaan spesialis keamanan siber dan teknologi informasi.',
                'bidang_perusahaan_id' => 3,
                'no_telp' => '08123456789',
                'website' => 'https://cybersecurity.com',
                'foto' => 'logo-cybersecurity.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}