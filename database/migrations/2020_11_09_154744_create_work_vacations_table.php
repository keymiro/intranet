<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_vacations', function (Blueprint $table) {
            $table->id();
            $table->date('startdate')->nullable()->comment('Fecha inicio vacaciones');
            $table->date('returndate')->nullable()->comment('Fecha de reanuación laborales');
            $table->date('fromdate')->nullable()->comment('periodo de causacion desde');
            $table->date('untildate')->nullable()->comment('periodo de causacion hasta');
            $table->string('businessdays')->nullable()->comment('No. de días hábiles disponibles para disfrutar');
            $table->string('requesteddays')->nullable()->comment('No. de días solicitados para disfrutar');
            $table->string('pendingdays')->nullable()->comment('No. de días que quedan pendientes para este periodo');
            $table->string('enjoydays')->nullable()->comment('No. dias a disfrutar');
            $table->string('observations')->nullable()->comment('observación de la solicitud de vacaciones');
            $table->unsignedBigInteger('user_id')->nullable()->comment('usuario que realiza la solicitud');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('igree')->nullable()->comment('aprobación (1)por parte del usuario que realiza la solicitud');
            $table->unsignedBigInteger('coordigree_id')->nullable()->comment('relaciona al coordinador correspondiente del usuario');
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable()->comment('aprobación de la solicitud por el coordinador, 1 aprobo 0 denego');

            $table->unsignedBigInteger('directigree_id')->nullable()->comment('relaciona al director correspondiente del usuario');;
            $table->foreign('directigree_id')->references('id')->on('users');
            $table->string('directigree')->nullable()->comment('aprobación de la solicitud por el director, 1 aprobo 0 denego');
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
        Schema::dropIfExists('work_vacations');
    }
}
