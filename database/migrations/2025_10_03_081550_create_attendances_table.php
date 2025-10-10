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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained('participants')->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha'])->default('Hadir');
            $table->string('note', 255)->nullable()->after('status');
            $table->foreignId('recorded_by')->nullable()->after('note')
                ->constrained('users')->nullOnDelete();
            $table->timestamp('check_in_time')->nullable();
            $table->string('check_in_ip_address')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->string('check_out_ip_address')->nullable();
            $table->timestamps();

            $table->unique(['participant_id', 'date']);

            // Index kombinasi untuk query anti-cheat
            $table->index(['check_in_ip_address', 'check_in_time'], 'att_in_ip_time_idx');
            $table->index(['check_out_ip_address', 'check_out_time'], 'att_out_ip_time_idx');
            // (Opsional) index date untuk laporan cepat
            $table->index(['participant_id', 'date'], 'att_participant_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
