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
            $table->string('nombre_usuario', 25);
            $table->string('apellido', 25);
            $table->string('email');
            $table->string('contrasenia');
            $table->string('dni');
            $table->longText('descripcion');
            $table->string('telefono');
            $table->string('direccion');
            $table->longText('foto');
            $table->dateTime('fecha_nacimiento');
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
