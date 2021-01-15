<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del incidente');
            $table->string('description')->comment('descripción del incidente');

            //foranea para prioridades
            $table->unsignedBigInteger('priority_id')->comment('relaciona la prioridad al incidente');
            $table->foreign('priority_id')->references('id')->on('priorities');

            $table->unsignedBigInteger('location_id')->comment('relaciona la ubicación al incidente');
            $table->foreign('location_id')->references('id')->on('locations');

            //foranea para cliente_id
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users');

            //forane del usuario soporte
            $table->unsignedBigInteger('support_id')->nullable();
            $table->foreign('support_id')->references('id')->on('users');


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
        Schema::dropIfExists('incidents');
    }
}
