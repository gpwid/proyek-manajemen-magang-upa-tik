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
            $table->foreignId('id_instansi');
            $table->date('tgl_surat');
            $table->strin('instansi');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('pembimbing_sekolah', 255);
            $table->string('kontak_pembimbing', 13);
            $table->date('tgl_suratmasuk');
            $table->enum('jenis_magang', ['Mandiri', 'MBKM', 'Sekolah']);
            $table->enum('status', ['Aktif', 'Pending', 'Selesai'])->default('Pending');
            $table->string('file_permohonan');
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
