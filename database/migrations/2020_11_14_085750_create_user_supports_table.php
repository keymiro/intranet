<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_supports', function (Blueprint $table) {
            $table->id();
            $table->string('names')->nullable()->comment('nombres del usuario que realiza la pqrf');
            $table->string('email')->nullable()->comment('email del usuario que realiza la pqrf');
            $table->string('phone')->nullable()->comment('cel del usuario que realiza la pqrf');
            $table->string('jobtitle')->nullable()->comment('cargo del usuario que realiza la pqrf');
            $table->string('eps')->nullable()->comment('eps del usuario que realiza la pqrf');
            $table->string('type')->nullable()->comment('typo de pqrf');
            $table->string('message','500')->nullable()->comment('mensaje del usuario que realiza la pqrf');
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
        Schema::dropIfExists('user_supports');
    }
}
