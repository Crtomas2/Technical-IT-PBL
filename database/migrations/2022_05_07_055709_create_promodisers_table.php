<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promodisers', function (Blueprint $table) {
            $table->id();
            $table->string('promodiser_id')->unique()->nullable();
            $table->string('Firstname');
            $table->string('Lastname');
            $table->string('Mobilenumber');
            $table->string('Location_code'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promodisers');
    }
};
