<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->comment('correo  del usuario');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('contraseña del usuario');
            $table->string('state')->nullable()->comment('Estado del usuario, 1 activo 0 inactivo');
            $table->string('type_func')->nullable()->comment('tipo de funcionario,1 administrativo 2 asistencial');;
            /* $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');*/
            $table->unsignedBigInteger('people_id')->nullable()->comment('Relaciona a la persona con el usuario');
            $table->foreign('people_id')
                ->references('id')
                ->on('peoples');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
