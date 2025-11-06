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
        Schema::table('participants', function (Blueprint $table) {
            try {
                $table->dropUnique('participants_nisnim_unique');
            } catch (\Exception $e) {
                // Handle the exception if the index does not exist
            }
        });

        DB::statement('ALTER TABLE `participants` MODIFY `nisnim` VARCHAR(20) NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // pastikan tidak ada nilai NULL atau kosong sebelum revert
        DB::statement("UPDATE `participants` SET `nisnim` = '-' WHERE `nisnim` IS NULL OR `nisnim` = ''");

        // ubah kembali NOT NULL
        DB::statement('ALTER TABLE `participants` MODIFY `nisnim` VARCHAR(20) NOT NULL');

        Schema::table('participants', function (Blueprint $table) {
            $table->unique('nisnim');
        });
    }
};
