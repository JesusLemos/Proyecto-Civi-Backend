<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Crear Ofertas
  Route::post('/crearoferta', 'CreacionOfertaController@CrearOferta');
  Route::get('/versolicitudes/{id}', 'VerSolicitudesController@VerSolicitudesEmpresas');
  Route::get('/verperfil/{id}', 'VerPerfilController@verPerfilEmpresa');
});