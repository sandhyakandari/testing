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
        Schema::create('draw_players_tournament', function (Blueprint $table) {
            $table->id('id');
            $table->string('player_id');
            $table->integer('draw_id');
            $table->string('seed')->nullable();
            $table->string('by')->nullable();
            // $table->string('roundOne')->default('no')->nullable();
            // $table->string('roundTwo')->default('no')->nullable();
            // $table->string('roundThree')->default('no')->nullable();
            // $table->string('roundFour')->default('no')->nullable();
            // $table->string('roundFive')->default('no')->nullable();
            // $table->string('roundSix')->default('no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draw_players_tournament');
    }
};
