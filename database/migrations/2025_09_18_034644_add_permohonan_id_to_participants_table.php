<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->unsignedBigInteger('permohonan_id')->nullable()->after('id');
            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['permohonan_id']);
            $table->dropColumn('permohonan_id');
        });
    }
};
