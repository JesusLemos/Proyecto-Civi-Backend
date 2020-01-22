<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertaTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferta_trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',150);
            $table->longText('descripcion');
            $table->integer('popularidad');
            $table->boolean('anuncio');
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_trabajo');
            $table->unsignedBigInteger('id_ciudad');
            $table->index(['id_empresa', 'id_trabajo', 'id_ciudad']);
            $table->dateTime('fecha_publicacion');
            $table->timestamps();
            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->foreign('id_trabajo')->references('id')->on('categoria_trabajos');
            $table->foreign('id_ciudad')->references('id')->on('ciudades');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oferta__trabajos');
    }
}
