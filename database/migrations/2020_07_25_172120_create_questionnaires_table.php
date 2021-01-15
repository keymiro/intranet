<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('nombre del cuestionario');
            $table->string('active')->default('1')->comment('estado del cuestionario, 1 activo 0 inactivo');
            $table->integer('try')->onDelete('cascade')->comment('número de intentos');
            $table->integer('time')->comment('duración del cuestionario');
            $table->unsignedBigInteger('user_id')->comment('usuario que crea el cuestionario');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('questionnaires');
    }
}
