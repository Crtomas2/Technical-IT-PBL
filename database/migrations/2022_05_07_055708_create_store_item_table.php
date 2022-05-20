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
        Schema::create('store_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->constrained();
            $table->unsignedBigInteger('storelocation_id');
            $table->foreign('storelocation_id')->references('id')->on('storelocations')->constrained();
            $table->unsignedBigInteger('locationcode_id');
            $table->foreign('locationcode_id')->references('id')->on('location_codes')->constrained();
            $table->unsignedBigInteger('storegroup_id');
            $table->foreign('storegroup_id')->references('id')->on('storegroups')->constrained();
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
        Schema::dropIfExists('store_items');
    }
};
