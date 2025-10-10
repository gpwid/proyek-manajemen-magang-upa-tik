<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->after('id')->constrained('users')->cascadeOnDelete();
            $table->string('nama', 50);
            $table->string('nip', 30)->unique();
            $table->string('email', 191)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
