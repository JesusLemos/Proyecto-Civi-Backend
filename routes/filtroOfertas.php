<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;

Route::group(['middleware' => ['cors']], function () {
    //Saca ofertas por popularidad
    Route::get('/ordenadas', 'OfertasTrabajosController@ofertasOrdenadas');

    //Saca todas las ciudades
    Route::get('/ciudades', 'OfertasTrabajosController@ofertasCiudades');

    //Saca las ofertas de la ciudad por parametro
    Route::get('/ciudad/{nombreciudad}', 'OfertasTrabajosController@ofertasCiudad');

    //Saca las ofertas que esten anunciado
    Route::get('/anuncio', 'OfertasTrabajosController@ofertasAnuncios');

    //Saca las ofertas de los puestos de trabajo por parametro
    Route::get('/puesto/{puesto}', 'OfertasTrabajosController@ofertasPuesto');

    Route::get('/omni/{omni}', 'OfertasTrabajosController@omniFiltro');

    Route::get('/salario/asc/{salario}', 'OfertasTrabajosController@ofertasSalarioAsc');

    Route::get('/salario/desc/{salario}', 'OfertasTrabajosController@ofertasSalarioDesc');

    Route::get('/salario-entre/asc/{salarioA}/{salarioB}', 'OfertasTrabajosController@ofertasSalarioEntreAsc');
});
