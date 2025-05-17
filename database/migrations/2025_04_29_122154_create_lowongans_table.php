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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->date('batas_pendaftaran');
            $table->enum('lokasi', ['malang','luar malang']);
            $table->enum('tipe_magang', ['onsite','remote']);
            $table->decimal('ipk', 3, 2)->nullable();
            $table->integer('jumlah_magang')->nullable();
            $table->bigInteger('perusahaan_id')->unsigned();
            $table->bigInteger('periode_id')->unsigned();
            $table->bigInteger('prodi_id')->unsigned()->nullable();
            $table->bigInteger('jenis_magang_id')->unsigned()->nullable();
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_magang_id')->references('id')->on('jenis_magang')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
