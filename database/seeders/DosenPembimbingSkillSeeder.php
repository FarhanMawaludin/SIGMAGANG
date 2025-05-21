<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenPembimbingSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen_pembimbing_skill')->insert([
            [
                'dosen_pembimbing_id' => 1,
                'skill_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dosen_pembimbing_id' => 1,
                'skill_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dosen_pembimbing_id' => 2,
                'skill_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
