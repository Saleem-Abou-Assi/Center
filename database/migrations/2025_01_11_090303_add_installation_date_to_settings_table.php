<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->date('installation_date')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('installation_date');
        });
    }
};
