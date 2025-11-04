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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_institute');
            $table->foreign('id_institute')->references('id')->on('institutes');
            $table->string('no_surat', 100)->unique();
            $table->date('tgl_surat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('pembimbing_sekolah', 255);
            $table->string('kontak_pembimbing', 13);
            $table->date('tgl_suratmasuk');
            $table->enum('jenis_magang', ['Mandiri', 'MBKM', 'Sekolah', 'Kemitraan', 'Lainnya']);
            $table->enum('status', ['Aktif', 'Proses', 'Selesai', 'Ditolak'])->default('Proses');
            $table->string('file_permohonan');
            $table->string('file_permohonan_nama_asli')->nullable();
            $table->unsignedBigInteger('file_permohonan_size')->nullable();
            $table->string('file_permohonan_mime')->nullable();
            $table->string('file_suratbalasan')->nullable();
            $table->string('file_suratbalasan_nama_asli')->nullable();
            $table->unsignedBigInteger('file_suratbalasan_size')->nullable();
            $table->string('file_suratbalasan_mime')->nullable();
            $table->string('catatan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
