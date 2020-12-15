<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdverseEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverse_events', function (Blueprint $table) {
            // usuario
            $table->id();
            $table->string('canoni')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('namepatient')->nullable();
            $table->string('documentpatient')->nullable();
            $table->string('description')->nullable();
            $table->string('consecutive');
            //foranea para usuario
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            //coordinador
            $table->string('unitanalysis')->nullable();
            $table->string('nameevent')->nullable();
            $table->string('coordinator')->nullable();
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
        Schema::dropIfExists('adverse_events');
    }
}
