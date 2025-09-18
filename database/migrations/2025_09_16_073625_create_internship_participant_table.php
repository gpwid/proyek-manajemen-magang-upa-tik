<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_participant', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_id')
                ->constrained('internship')
                ->cascadeOnDelete();

            $table->foreignId('participant_id')
                ->constrained('participants')
                ->cascadeOnDelete();

            $table->timestamps();

            // opsional: cegah duplikasi
            $table->unique(['internship_id', 'participant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_participant');
    }
};
