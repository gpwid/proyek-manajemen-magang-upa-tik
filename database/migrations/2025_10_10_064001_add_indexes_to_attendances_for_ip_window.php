<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Index kombinasi untuk query anti-cheat
            $table->index(['check_in_ip_address', 'check_in_time'], 'att_in_ip_time_idx');
            $table->index(['check_out_ip_address', 'check_out_time'], 'att_out_ip_time_idx');
            // (Opsional) index date untuk laporan cepat
            $table->index(['participant_id', 'date'], 'att_participant_date_idx');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex('att_in_ip_time_idx');
            $table->dropIndex('att_out_ip_time_idx');
            $table->dropIndex('att_participant_date_idx');
        });
    }
};
