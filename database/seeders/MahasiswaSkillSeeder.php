<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa_skill')->insert([
            [
                'mahasiswa_id' => 1,
                'skill_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 1,
                'skill_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 2,
                'skill_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 2,
                'skill_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mahasiswa_id' => 3,
                'skill_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
