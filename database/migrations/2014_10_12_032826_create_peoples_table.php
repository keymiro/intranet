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
            $table->string('document');
            $table->string('names');
            $table->string('lastnames');
            $table->date('datebirth')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('jobtitle_id')->nullable();
            $table->foreign('jobtitle_id')
                ->references('id')
                ->on('jobtitles');
            $table->unsignedBigInteger('area_id')->nullable();
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
