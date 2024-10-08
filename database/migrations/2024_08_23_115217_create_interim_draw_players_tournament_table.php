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
        Schema::create('interim_draw_players_tournament', function (Blueprint $table) {
            $table->id();
            $table->string('player_id');
            $table->string('player_name');
            $table->date('dob');
            $table->string('aita_number')->nullable();
            $table->string('rank')->nullable();
            $table->integer('interim_draw_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interim_draw_players_tournament');
    }
};
