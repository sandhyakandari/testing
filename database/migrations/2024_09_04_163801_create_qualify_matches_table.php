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
        Schema::create('qualify_matches', function (Blueprint $table) {
            $table->id();
            $table->integer('interim_draw_id');
            $table->integer('qualify_round_id');
            $table->string('player1_id');
            $table->string('player2_id');
            $table->string('status')->nullable();
            $table->string('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualify_matches');
    }
};
