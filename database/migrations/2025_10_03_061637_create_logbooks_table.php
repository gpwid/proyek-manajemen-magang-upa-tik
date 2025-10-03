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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();

            // --- TAMBAHKAN BARIS INI ---
            $table->foreignId('internship_id')->constrained('internship')->onDelete('cascade');

            $table->foreignId('participant_id')->constrained('participants')->onDelete('cascade');
            $table->date('date');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->text('tasks_completed');
            $table->text('description')->nullable();
            $table->timestamps();

            // Constraint unik sekarang harus berdasarkan 3 kolom
            $table->unique(['internship_id', 'participant_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
