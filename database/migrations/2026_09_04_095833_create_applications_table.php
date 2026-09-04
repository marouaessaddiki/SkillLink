<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Mission
            $table->foreignId('mission_id')
                ->constrained('missions')
                ->onDelete('cascade');

            // Freelance
            $table->foreignId('freelance_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Message / motivation of the freelance
            $table->text('cover_letter')->nullable();

            // Application status
            $table->enum('status', [
                'pending',
                'accepted',
                'rejected'
            ])->default('pending');

            $table->timestamps();

            // Same freelance cannot apply twice to same mission
            $table->unique(['mission_id', 'freelance_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};