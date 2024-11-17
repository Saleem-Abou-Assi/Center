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
        Schema::create('a_p_d_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PD_id');
            $table->foreign('PD_id')->references('id')->on('patient_depts')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('A_id');
            $table->foreign('A_id')->references('id')->on('accounters')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('check_in_type',['body','eye','bones']);
            $table->string('given_cure');
            $table->string('tools');
            $table->integer('full_cost');
            $table->enum('status',['paid','unpaid']);      
            $table->string('patient_name'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_p_d_s');
    }
};
