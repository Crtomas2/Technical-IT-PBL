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
            $table->bigIncrements('id');
            $table->string('Firstname');
            $table->string('Middlename');
            $table->string('lastname');
            $table->string('mobilenumber');
            $table->string('Storename');
            $table->string('Storelocation');
            $table->string('LocationCode');
            $table->string('StoreGroup');
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
