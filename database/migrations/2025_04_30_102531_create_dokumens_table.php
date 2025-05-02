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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->morphs('documentable');
            $table->enum('tipe', ['CV', 'Sertifikat', 'Surat Pengantar','Transkrip Nilai']);
            $table->string('file_path');
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->text('catatan_validasi')->nullable();   
            $table->timestamps();       
        }); 
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
