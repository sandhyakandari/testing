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
        Schema::create('player_register_tournament', function (Blueprint $table) {
            $table->id('register_id');
            $table->integer('player_id');
            $table->integer('tournament_id');
            $table->string('category');
            $table->string('sub_category');
            $table->string('status')->default('unapprove');
            $table->timestamp('register_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_register_tournament');
    }
};
