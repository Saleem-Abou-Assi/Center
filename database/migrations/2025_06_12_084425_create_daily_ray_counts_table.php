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
        Schema::create('daily_ray_counts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('ax_start_count');
            $table->integer('ax_end_count');
            $table->integer('ay_start_count');
            $table->integer('ay_end_count');
            $table->integer('again_start_count');
            $table->integer('again_end_count');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_ray_counts');
    }
};
