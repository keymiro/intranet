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
            $table->string('names')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('jobtitle')->nullable();
            $table->string('eps')->nullable();
            $table->string('type')->nullable();
            $table->string('message','500')->nullable();
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
