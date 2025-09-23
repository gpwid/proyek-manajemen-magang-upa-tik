<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('nik', 16);
            $table->string('nisnim', 20);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jurusan', 50);
            $table->string('kontak_peserta', 13);
            $table->year('tahun_aktif', 4);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
