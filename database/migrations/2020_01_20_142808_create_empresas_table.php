<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nif');
            $table->string('email');
            $table->string('contrasenia');
            $table->longText('foto');
            $table->string('nombre_empresa');
            $table->longText('descripcion_empresa');
            $table->unsignedBigInteger('id_categoria');
            $table->index('id_categoria');
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->foreign('id_categoria')->references('id')->on('categoria_trabajos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
