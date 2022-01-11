<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->date('dob');
            $table->string('hair_color');
            $table->string('eye_color');
            $table->string('address');
            $table->string('gender');
            $table->string('race');
            $table->integer('height');
            $table->integer('weight');
            $table->string('dl_type')->default('UNL');
            $table->string('dl_status')->default('V');
            $table->date('dl_expiry')->nullable();
            $table->string('wl_status')->default('U');
            $table->date('wl_expiry')->nullable();
            $table->string('bl_status')->default('U');
            $table->date('bl_expiry')->nullable();
            $table->string('pl_type')->default('U');
            $table->string('pl_status')->default('V');
            $table->date('pl_expiry')->nullable();
            $table->boolean('dead')->default(false);
            $table->timestamp('dead_since')->nullable();
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
        Schema::dropIfExists('characters');
    }
}
