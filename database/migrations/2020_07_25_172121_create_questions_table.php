<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->comment('almacena la imagen del cuestionario');
            $table->string('statement')->comment('descripción de la pregunta');
            $table->string('option_a')->comment('opcion a');
            $table->string('option_b')->comment('opcion b');
            $table->string('option_c')->comment('opcion c');
            $table->string('option_d')->comment('opcion d');

            //foranea para opción correcta
            $table->unsignedBigInteger('correctoption_id')->comment('relaciona la opción correcta a la pregunta');
            $table->foreign('correctoption_id')
                ->references('id')
                ->on('correctoptions')->onDelete('cascade');
            //foranea para relacionar el formulario
            $table->unsignedBigInteger('questionnaire_id')->comment('relaciona la pregunta al cuestionario');
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
}
