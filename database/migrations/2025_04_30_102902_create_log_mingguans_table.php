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
        Schema::create('log_mingguan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengajuan_id')->unsigned();
            $table->integer('minggu');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->text('dosen_feedback')->nullable();
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_mingguan');
    }
};
