<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('nombre del archivo');
            $table->string('url')->nullable()->comment('url del archivo');
            $table->string('ext')->nullable()->comment('extensión del archivo');
            $table->unsignedBigInteger('area_id')->nullable()->comment('area a la que corresponde el archivo');
            $table->foreign('area_id')->references('id')
                ->on('areas');
            $table->unsignedBigInteger('category_archive_id')->nullable()->comment('categoria del archivo');
            $table->foreign('category_archive_id')
                ->references('id')->on('category_archives');
            $table->unsignedBigInteger('user_id')->nullable()->comment('usuario que carga el archivo');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('archives');
    }
}
