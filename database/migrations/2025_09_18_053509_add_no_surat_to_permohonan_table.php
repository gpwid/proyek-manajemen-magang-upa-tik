<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_no_surat_to_permohonan_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('no_surat', 100)->unique()->after('id_institute');
        });
    }
    public function down(): void {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropUnique(['no_surat']);
            $table->dropColumn('no_surat');
        });
    }
};
