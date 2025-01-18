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
        Schema::create('lazer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lazer_id');
            $table->foreign('lazer_id')->references('id')->on('lazers')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('l_details_id');
            $table->foreign('l_details_id')->references('id')->on('l_details')->onDelete('cascade')->onUpdate('cascade');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lazer_details');
    }
};
