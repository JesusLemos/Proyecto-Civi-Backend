<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_usuario', 25)->required();
            $table->string('apellido', 25)->required();
            $table->string('email')->unique()->required();
            $table->string('contrasenia')->required();
            $table->string('dni')->required();;
            $table->longText('descripcion')->required();
            $table->string('telefono')->required();
            $table->string('direccion')->required();
            $table->longText('foto')->required();
            $table->dateTime('fecha_nacimiento')->required();
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
        Schema::dropIfExists('usuarios');
    }
}
