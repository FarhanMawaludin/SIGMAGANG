<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_skill', function (Blueprint $table) {
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('skill_id')->constrained('skill')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_skill');
    }
};
