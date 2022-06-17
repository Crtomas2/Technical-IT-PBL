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
        Schema::create('promodiser_assignations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promodisers_id')->constrained('promodisers');
            $table->foreignId('location_codes_id')->constrained('location_codes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promodiser_assignations');
    }
};
