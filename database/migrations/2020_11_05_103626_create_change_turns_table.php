<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_turns', function (Blueprint $table) {
            $table->id();
            $table->string('numberchangeturn')->nullable();
            $table->date('datechangeturn')->nullable();
            $table->string('tchangeturn')->nullable();
            $table->string('namechange')->nullable();
            $table->string('celchange')->nullable();
            $table->date('returnchangeturn')->nullable();
            $table->string('t1changeturn')->nullable();
            $table->string('observations')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('igree')->nullable();
            $table->string('rdaterrhh')->nullable();

            $table->unsignedBigInteger('coordigree_id')->nullable();
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable();
            $table->unsignedBigInteger('rrhhigree_id')->nullable();
            $table->unsignedBigInteger('changeigree_id')->nullable();
            $table->foreign('changeigree_id')->references('id')->on('users');
            $table->string('changeigree')->nullable();
            $table->string('v')->default(1);
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
        Schema::dropIfExists('change_turns');
    }
}
