<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skill')->insert([
            [
                'nama' => 'PHP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'JavaScript',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'React',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'MySQL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Git',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
