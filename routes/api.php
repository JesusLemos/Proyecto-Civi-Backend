<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/prueba', 'PruebaController@getAll');
Route::get('/ofertasordenadas', 'OfertasPopularidadController@ofertasOrdenadas');
Route::get('/ofertasporciudades', 'OfertasCiudadsController@ofertasCiudades');
Route::get('/ofertasporciudad/{nombreciudad}', 'OfertasCiudadsController@ofertasCiudad');
Route::get('/ofertasporanuncio', 'OfertasAnunciosController@ofertasAnuncios');

