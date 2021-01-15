<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_permits', function (Blueprint $table) {
            $table->id();
            $table->string('especify')->nullable()->comment('0 para solicitud permiso, 1 para autorizacion'); /*   */
            $table->string('typepaid')->nullable()->comment('0 para remunerado 1 para no remunerado'); /*0 para remunerado 1 para no remunerado*/
            $table->time('jentry')->nullable()->comment('hora de entrada');
            $table->time('jexit')->nullable()->comment('hora de salida');
            $table->date('datepermit')->nullable()->comment('fecha del permiso');
            $table->string('timepermit')->nullable()->comment('duración del permiso');
            $table->time('pexit')->nullable()->comment('hora de salida');
            $table->time('preturn')->nullable()->comment('hora de entrada');
            $table->string('description',1000)->nullable()->comment('descripción del permiso');
            $table->string('observations',1000)->nullable()->comment('Observaciones del permiso');
            $table->string('igree')->nullable()->comment('quien solicita el permiso da su aprobación, 1 aprobo');

            //Radicación
            $table->timestamp('rdate')->nullable()->comment('radicación por rrhh');

            //foranea para usuario y tipo permiso
            $table->unsignedBigInteger('typepermit_id')->nullable()->comment('relaciona el tipo de permiso con el permiso');;
            $table->foreign('typepermit_id')->references('id')->on('type_permits');
            $table->unsignedBigInteger('user_id')->nullable()->comment('relaciona al usuario que solicito el permiso');
            $table->foreign('user_id')->references('id')->on('users');

            //aceptación de jefes del permiso
            $table->unsignedBigInteger('coordigree_id')->nullable()->comment('relaciona al coordinador que aprobo o denego el permiso');
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable()->comment('coordinador  1 aprobo 0 denego');
            $table->unsignedBigInteger('directigree_id')->nullable()->comment('relaciona a dirección que aprobo o denego el permiso');
            $table->foreign('directigree_id')->references('id')->on('users');
            $table->string('directigree')->nullable()->comment('dirección  1 aprobo 0 denego');
            $table->unsignedBigInteger('managigree_id')->nullable()->comment('relaciona a gerencia que aprobo o denego el permiso');
            $table->foreign('managigree_id')->references('id')->on('users');
            $table->string('managigree')->nullable()->comment('gerencia  1 aprobo 0 denego');
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
        Schema::dropIfExists('work_permits');
    }
}
