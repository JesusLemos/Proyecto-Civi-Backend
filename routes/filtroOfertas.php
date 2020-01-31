<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
    //Saca ofertas por popularidad
    Route::get('/ordenadas', 'OfertasPopularidadController@ofertasOrdenadas');

    //Saca todas las ciudades
    Route::get('/ciudades', 'OfertasCiudadsController@ofertasCiudades');

    //Saca las ofertas de la ciudad por parametro
    Route::get('/ciudad/{nombreciudad}', 'OfertasCiudadsController@ofertasCiudad');

    //Saca las ofertas que esten anunciado
    Route::get('/anuncio', 'OfertasAnunciosController@ofertasAnuncios');

    //Saca las ofertas de los puestos de trabajo por parametro
    Route::get('/puesto/{puesto}', 'OfertasPuestosController@ofertasPuesto');

});