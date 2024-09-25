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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('draw_id');
            $table->string('player_id');
            $table->string('roundOne')->nullable();
            $table->string('roundTwo')->nullable();
            $table->string('roundThree')->nullable();
            $table->string('roundFour')->nullable();
            $table->string('roundFive')->nullable();
            $table->string('roundSix')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
