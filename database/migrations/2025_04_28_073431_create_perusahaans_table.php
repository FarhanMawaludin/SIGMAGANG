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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('email');
            $table->string('website');
            $table->string('foto');
            $table->bigInteger('bidang_perusahaan_id')->unsigned()->nullable();
            $table->foreign('bidang_perusahaan_id')->references('id')->on('bidang_perusahaan')->onDelete('set null')->onUpdate('cascade');               $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
