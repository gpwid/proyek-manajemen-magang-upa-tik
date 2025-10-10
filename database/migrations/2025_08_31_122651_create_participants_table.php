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
            $table->foreignId('supervisor_id')->nullable()->constrained('supervisors')->nullOnDelete();
            $table->unsignedBigInteger('permohonan_id')->nullable();
            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('id');
            $table->string('nama', 50);
            $table->string('nik', 16)->unique();
            $table->string('nisnim', 20)->unique();
            $table->string('email')->unique()->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('institute_id')->nullable()->constrained('institutes')->onDelete('set null');
            $table->string('jurusan', 50)->nullable();
            $table->string('kontak_peserta', 13)->nullable();
            $table->string('alamat_asal', 255)->nullable();
            $table->string('nama_wali', 50)->nullable();
            $table->string('kontak_wali', 13)->nullable();
            $table->year('tahun_aktif', 4);
            $table->enum('status', ['pending', 'approved', 'rejected', 'nonactive'])->default('pending');
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
