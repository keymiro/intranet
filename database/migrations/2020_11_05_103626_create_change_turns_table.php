<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_turns', function (Blueprint $table) {
            $table->id();
            $table->string('numberchangeturn')->nullable()->comment('Número de cambios de turno');
            $table->date('datechangeturn')->nullable()->comment('fecha programada de turno');
            $table->string('tchangeturn')->nullable()->comment('horario');
            $table->date('returnchangeturn')->nullable()->comment('fecha devolución turno');
            $table->string('t1changeturn')->nullable()->comment('hobservaciones del cambio de turno');
            $table->unsignedBigInteger('user_id')->nullable()->comment('relaciona al usuario que solicito el cambio de turno');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('igree')->nullable()->comment('el usuario que solicito el cambio de turno  1 aprueba');
            $table->string('rdaterrhh')->nullable();
            $table->unsignedBigInteger('user_change_id')->nullable()->comment('Cédula quien reemplaza');
            $table->foreign('user_change_id')->references('id')->on('users');
            $table->string('user_change_igree')->nullable()->comment('el usuario que va a reemplazar 1 aprobo la solicitud');



            $table->unsignedBigInteger('coordigree_id')->nullable()->comment('relaciona al coordinador que aprobo o denego el cambio de turno');
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable()->comment('coordinador 1 aprueba o 0 rechaza');
            $table->unsignedBigInteger('rrhhigree_id')->nullable()->comment('radicación por rrhh');
            $table->unsignedBigInteger('changeigree_id')->nullable()->comment(' relaciona al usuario que va reemplazar');
            $table->foreign('changeigree_id')->references('id')->on('users');
            $table->string('changeigree')->nullable();
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
        Schema::dropIfExists('change_turns');
    }
}
