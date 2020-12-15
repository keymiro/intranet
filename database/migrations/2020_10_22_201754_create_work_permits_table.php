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
            $table->string('especify')->nullable(); /*  0 para solicitud permiso, 1 para autorizacion */
            $table->string('typepaid')->nullable(); /*0 para remunerado 1 para no remunerado*/
            $table->time('jentry')->nullable();
            $table->time('jexit')->nullable();
            $table->date('datepermit')->nullable();
            $table->string('timepermit')->nullable();
            $table->time('pexit')->nullable();
            $table->time('preturn')->nullable();
            $table->string('description',1000)->nullable();
            $table->string('observations',1000)->nullable();
            $table->string('igree')->nullable();

            //Radicación
            $table->timestamp('rdate')->nullable();

            //foranea para usuario y tipo permiso
            $table->unsignedBigInteger('typepermit_id')->nullable();
            $table->foreign('typepermit_id')->references('id')->on('type_permits');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            //aceptación de jefes del permiso
            $table->unsignedBigInteger('coordigree_id')->nullable();
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable();
            $table->unsignedBigInteger('directigree_id')->nullable();
            $table->foreign('directigree_id')->references('id')->on('users');
            $table->string('directigree')->nullable();
            $table->unsignedBigInteger('managigree_id')->nullable();
            $table->foreign('managigree_id')->references('id')->on('users');
            $table->string('managigree')->nullable();
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
