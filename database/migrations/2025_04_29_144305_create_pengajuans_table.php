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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'rejected', 'accepted', 'completed'])->default('pending');
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->bigInteger('lowongan_id')->unsigned();
            $table->foreign('lowongan_id')->references('id')->on('lowongan')->onDelete('cascade');
            $table->float('skor_spk')->default(0);
            $table->bigInteger('dosen_id')->unsigned()->nullable();
            $table->foreign('dosen_id')->references('id')->on('dosen_pembimbing')->onDelete('set null');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
