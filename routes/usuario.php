<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Solicitar Oferta
  Route::post('/solicitaroferta', 'SolicitarOfertaController@solicitarOferta');
});