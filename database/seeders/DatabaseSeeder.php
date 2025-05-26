<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users first
        $this->call(UserSeeder::class);
        
        // Seed reference data
        $this->call(ProdiSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(JenisMagangSeeder::class);
        $this->call(BidangPerusahaanSeeder::class);
        $this->call(SkillSeeder::class);
        
        // Seed main entities
        $this->call(PerusahaanSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(DosenPembimbingSeeder::class);
        
        // Seed relationships
        $this->call(MahasiswaSkillSeeder::class);
        $this->call(DosenPembimbingSkillSeeder::class);
        
        // Seed opportunities
        $this->call(LowonganSeeder::class);
        
        // Seed documents
        $this->call(DokumenSeeder::class);
        
        // Seed applications
        $this->call(PengajuanSeeder::class);
        
        // Seed logs
        $this->call(LogMingguanSeeder::class);
        $this->call(LogHarianSeeder::class);
    }
}
