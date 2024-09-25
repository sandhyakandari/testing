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
        Schema::create('draw', function (Blueprint $table) {
            $table->id('draw_id');
            $table->integer('interim_draw_id');
            $table->string('player_num');
            // $table->string('seed')->nullable();
            // $table->string('by')->default('no')->nullable();
            // $table->string('player_id');
            $table->integer('tournament_id');
            $table->string('roundOne')->nullable();
            $table->string('roundTwo')->nullable();
            $table->string('roundThree')->nullable();
            $table->string('roundFour')->nullable();
            $table->string('roundFive')->nullable();
            $table->string('roundSix')->nullable();
            $table->string('winner')->nullable();
            $table->string('runnerup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draw');
    }
};
