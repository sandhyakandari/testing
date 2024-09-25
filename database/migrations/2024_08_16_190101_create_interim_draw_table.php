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
        Schema::create('interim_draw', function (Blueprint $table) {
            $table->id();
            $table->integer('tournament_id');
            $table->string('draw_type');
            $table->string('player_num');
            // $table->string('player_id');
            // $table->string('player_name');
            $table->string('subCategory');
            $table->string('gender');
            // $table->date('dob');
            // $table->string('aita_number')->nullable();
            // $table->string('rank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interim_draw');
    }
};
