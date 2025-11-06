<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifikasi tabel users
        Schema::table('users', function (Blueprint $table) {
            // Drop unique index jika ada
            try {
                $indexes = DB::select("SHOW INDEX FROM users WHERE Key_name = 'users_nisnim_unique'");
                if (! empty($indexes)) {
                    $table->dropUnique('users_nisnim_unique');
                }
            } catch (\Throwable $e) {
                // Abaikan jika index tidak ada
            }

            // Ubah kolom menjadi nullable
            DB::statement('ALTER TABLE `users` MODIFY `nisnim` VARCHAR(20) NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert perubahan pada tabel users
        DB::statement("UPDATE `users` SET `nisnim` = '-' WHERE `nisnim` IS NULL OR `nisnim` = ''");
        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `users` MODIFY `nisnim` VARCHAR(20) NOT NULL');
            $table->unique('nisnim');
        });
    }
};
