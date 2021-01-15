<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('document')->comment('documento del usuario');
            $table->string('names')->comment('Nombres del usuario');
            $table->string('lastnames')->comment('Apellidos del usuario');
            $table->date('datebirth')->comment('Fecha de nacimiento del usuario')->nullable();
            $table->string('phone')->comment('Celular del usuario');
            $table->string('address')->comment('Dirección del usuario');
            $table->unsignedBigInteger('jobtitle_id')->nullable()->comment('relaciona el cargo en la entidad del usuario');
            $table->foreign('jobtitle_id')
                ->references('id')
                ->on('jobtitles');
            $table->unsignedBigInteger('area_id')->comment('relaciona el area en la entidad del usuario')->nullable();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas');
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
        Schema::dropIfExists('peoples');
    }
}
