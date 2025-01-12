<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lazers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id");
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("doctor_id");
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('raysCount');
            $table->string('point');
            $table->integer('power');
            $table->string('speed');
            $table->string('pulse');
            $table->enum('device',['again','ax','ay']);
            $table->double('real_price')->nullable();
            $table->double('lazer_price');
            $table->text('notes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lazers');
    }
};
