<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->string('email', 191)->unique()->nullable();
            // jika belum ada user_id, kamu bisa tambahkan juga di sini:
            // $table->foreignId('user_id')->nullable()->unique()->constrained('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn('email');
        });
    }
};
