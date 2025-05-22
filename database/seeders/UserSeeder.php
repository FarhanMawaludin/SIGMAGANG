<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mahasiswa 1',
                'email' => 'mahasiswa1@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mahasiswa 2',
                'email' => 'mahasiswa2@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now()
            ],
[
                'name' => 'Dosen 1',
                'email' => 'dosen@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen_pembimbing',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
