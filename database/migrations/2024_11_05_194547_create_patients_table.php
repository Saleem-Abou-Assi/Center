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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('Gender',['male','female']);
            $table->string('job');
            $table->string('phone');
            $table->string('address');
            $table->string('relation');
            $table->string('childerCount')->nullable();
            $table->boolean('smooking')->nullable();
            $table->text('oldSurgery')->nullable();
            $table->string('alirgy')->nullable();
            $table->string('disease')->nullable();
            $table->string('dite')->nullable();
            $table->string('permenantCure')->nullable();
            $table->string('Cosmetic')->nullable();
            $table->string('CurrentDiseas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
