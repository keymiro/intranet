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
            $table->date('startdate')->nullable();
            $table->date('returndate')->nullable();
            $table->date('fromdate')->nullable();
            $table->date('untildate')->nullable();
            $table->string('businessdays')->nullable();
            $table->string('requesteddays')->nullable();
            $table->string('pendingdays')->nullable();
            $table->string('enjoydays')->nullable();
            $table->string('observations')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('igree')->nullable();
            $table->unsignedBigInteger('coordigree_id')->nullable();
            $table->foreign('coordigree_id')->references('id')->on('users');
            $table->string('coordigree')->nullable();

            $table->unsignedBigInteger('directigree_id')->nullable();
            $table->foreign('directigree_id')->references('id')->on('users');
            $table->string('directigree')->nullable();
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
        Schema::dropIfExists('work_vacations');
    }
}
