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
        Schema::create('lazer_price', function (Blueprint $table) {
            $table->id();
            $table->double('ax_price')->default(0);
            $table->double('ay_price')->default(0);
            $table->double('again_+price')->default(0);
            
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lazer_price');
    }
};
