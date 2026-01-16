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
        Schema::create('lowongan_skill', function (Blueprint $table) {
            $table->foreignId('lowongan_id')->constrained('lowongan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('skill_id')->constrained('skill')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_skill');
    }
};
