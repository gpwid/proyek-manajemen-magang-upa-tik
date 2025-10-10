<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Status kehadiran: Hadir (default), Izin, Sakit, Alpha
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha'])
                  ->default('Hadir')
                  ->after('date');

            // Keterangan tambahan ketika Izin/Sakit
            $table->string('note', 255)->nullable()->after('status');

            // User admin yang mencatat manual (opsional)
            $table->foreignId('recorded_by')->nullable()->after('note')
                  ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['recorded_by']);
            $table->dropColumn(['status', 'note', 'recorded_by']);
        });
    }
};
