<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;

Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Solicitar Oferta
  Route::group(['middleware'=>['tokenUsuario']], function (){
    //Solicita una oferta
  Route::post('/solicitaroferta', 'SolicitarOfertaController@solicitarOferta');
   
  //Rechaza una solicitud que este en estado pendiente
  Route::post('/rechazarsolicitud', 'AdministrarSolicitudesUsuariosController@AdministrarSolicitud');
  
  //Muestra las solicitudes de un usuario
  Route::get('/versolicitudes/{id}', 'VerSolicitudesController@VerSolicitudesUsuario');
  //Muestra el perfil de un usuario
  Route::get('/verperfil/{id}', 'VerPerfilController@verPerfilUsuario');
  Route::post('/modificarperfil', 'ModificarPerfilUsuarioController@CambiarPerfilUsuario');
});
Route::post('/borrarsolicitud', 'EliminarSolicitudUsuariosController@borrarSolicitud');
    //Se crea un usuario
  Route::post('/registro', 'Auth\RegisterUsuarioController@create');
  //Se logea un usuario
  Route::post('/login', 'Auth\LoginUsuarioController@loginUsuario');
  
});