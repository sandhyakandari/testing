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
        //
        Schema::table('players', function (Blueprint $table) {
            $table->id('player_id');
            $table->integer('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('guardian_name');
            $table->date('dob');
            $table->string('phone');
            $table->string('email');
            $table->string('district');
            $table->string('state');
            $table->string('country');
            $table->string('photo');
            $table->boolean('hereBy_agreement')->nullable()->default(false);
            $table->boolean('disputeShall_agreement')->nullable()->default(false);
            $table->date('register_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
