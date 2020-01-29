<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Solicitar Oferta
  Route::group(['middleware'=>['tokenUsuario']], function (){
  Route::post('/solicitaroferta', 'SolicitarOfertaController@solicitarOferta');
  Route::get('/versolicitudes/{id}', 'VerSolicitudesController@VerSolicitudesUsuario');
  Route::get('/verperfil/{id}', 'VerPerfilController@verPerfilUsuario');
});
  Route::post('/registro', 'Auth\RegisterUsuarioController@create');
  Route::post('/validar', 'Auth\RegisterUsuarioController@validator');
  Route::post('/login', 'Auth\LoginUsuarioController@loginUsuario');
  
});