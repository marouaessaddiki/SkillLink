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
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('email');
            $table->string('specialization')->nullable()->after('title');
            $table->text('bio')->nullable()->after('specialization');
            $table->json('skills')->nullable()->after('bio');
            $table->string('location')->nullable()->after('skills');
            $table->string('availability')->default('available')->after('location');
            $table->unsignedSmallInteger('years_of_experience')->nullable()->after('availability');
            $table->json('experiences')->nullable()->after('years_of_experience');
            $table->json('portfolio')->nullable()->after('experiences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'specialization',
                'bio',
                'skills',
                'location',
                'availability',
                'years_of_experience',
                'experiences',
                'portfolio',
            ]);
        });
    }
};
