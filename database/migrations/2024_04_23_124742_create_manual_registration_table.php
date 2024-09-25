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
        Schema::create('manual_registration', function (Blueprint $table) {
            $table->id('manual_register_id');
            $table->integer('academy_id');
            $table->integer('tournament_id');
            $table->string('rank');
            $table->string('name');
            $table->string('gender');
            $table->string('category');
            $table->string('sub_category');
            $table->date('dob');
            $table->string('aita_number')->nullable();
            $table->datetime('register_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_registration');
    }
};
