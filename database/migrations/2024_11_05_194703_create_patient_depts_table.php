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
        Schema::create('patient_depts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('dept_id');
            $table->foreign('dept_id')->references('id')->on('departments');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->string('doctor_name');
            $table->string('illness');
            $table->text('description');
            $table->string('cure');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_depts');
    }
};
