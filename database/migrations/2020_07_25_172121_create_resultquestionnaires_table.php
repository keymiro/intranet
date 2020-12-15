<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultquestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultquestionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('score')->nullable();
            $table->unsignedBigInteger('questionnaire_id');
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')->onDelete('cascade');
            $table->unsignedBigInteger('correctoption_id')
                ->default('0')
                ->nullable()->onDelete('cascade');
            $table->foreign('correctoption_id')
                ->references('id')
                ->on('correctoptions')->onDelete('cascade');
            $table->unsignedBigInteger('repetition_id');
            $table->foreign('repetition_id')
                ->references('id')
                ->on('repetitions')->onDelete('cascade');
            $table->string('pass')->nullable();
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
        Schema::dropIfExists('resultquestionnaires');
    }
}
