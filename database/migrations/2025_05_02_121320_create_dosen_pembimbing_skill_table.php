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
        Schema::create('dosen_pembimbing_skill', function (Blueprint $table) {
            $table->foreignId('dosen_pembimbing_id')->constrained('dosen_pembimbing')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('skill_id')->constrained('skill')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_pembimbing_skill');
    }
};
