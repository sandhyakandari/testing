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
        Schema::create('academies', function (Blueprint $table) {
            $table->id('academy_id');
            $table->integer('id');
            $table->string('name');
            $table->string('owner_name');
            $table->string('phone');
            $table->string('email');
            $table->string('stay');
            $table->string('no_of_court');
            $table->string('hard');
            $table->string('clay');
            $table->string('grass');
            $table->string('address');
            $table->string('city');
            $table->string('pin');
            $table->string('state');
            $table->string('photo');
            $table->string('web');
            $table->string('geo_location');
            $table->text('aboutAcademy')->nullable();
            $table->text('aboutDescription')->nullable();
            $table->text('our_team')->nullable();
            $table->text('training_programmes')->nullable();
            $table->text('our_achievements')->nullable();
            $table->boolean('publish')->default(false)->nullable();
            $table->string('show_on_home')->default('no');
            $table->date('register_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academies');
    }
};
