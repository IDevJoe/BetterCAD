<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('insurance_status');
            $table->string('state');
            $table->string('registration_status');
            $table->unsignedBigInteger('character_id');
            $table->timestamps();

            $table->unique(['plate_number', 'state']);
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
