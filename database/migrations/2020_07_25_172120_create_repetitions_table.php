<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repetitions', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable()->comment('intentos del cuestionario');
            $table->unsignedBigInteger('questionnaire_id')->comment('relaciona los intentos con el cuestionario');
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires');
            $table->unsignedBigInteger('user_id')->comment('relaciona el intento con el usuario');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('repetitions');
    }
}
