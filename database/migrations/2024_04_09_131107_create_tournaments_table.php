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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id('tournament_id');
            $table->string('tournamentName');
            $table->integer('academy_id');
            $table->string('category');
            $table->string('subCategory');
            $table->string('surface');
            $table->string('city');
            $table->datetime('date');
            $table->datetime('lastDate');
            $table->string('price');
            $table->string('image');
            $table->integer('winner_id')->nullable();
            $table->integer('runnerup_id')->nullable();
            $table->text('aboutTournament')->nullable();
            $table->string('status')->default('pending');
            $table->datetime('added_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
