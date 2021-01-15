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
            $table->string('canoni')->nullable()->comment('indica si el usuario  envia el reporte en anonimato, 1 anonimo');
            $table->unsignedBigInteger('area_id')->comment('relaciona el area con el envento adverso reportado');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('location_id')->comment('relaciona el area con el envento adverso reportado');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('namepatient')->nullable()->comment('nombre del paciente');
            $table->string('documentpatient')->nullable()->comment('documento del paciente');
            $table->string('description')->nullable()->comment('descripción del evento adverso');
            $table->string('consecutive');
            //foranea para usuario
            $table->unsignedBigInteger('user_id')->nullable()->comment('relaciona al usuario que reporto');
            $table->foreign('user_id')->references('id')->on('users');

            //coordinador
            $table->string('unitanalysis')->nullable()->comment('unidad de analisis');
            $table->string('nameevent')->nullable()->comment('nombre del evento');
            $table->string('coordinator')->nullable()->comment('coordinador');
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
