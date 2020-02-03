<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;

Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Solicitar Oferta
  Route::group(['middleware'=>['tokenUsuario']], function (){
    //Solicita una oferta
  Route::post('/solicitaroferta', 'UsuarioController@solicitarOferta');
   
  //Rechaza una solicitud que este en estado pendiente
  Route::post('/rechazarsolicitud', 'UsuarioController@AdministrarSolicitud');
  //El usuario deja de ver la solicitud que haya seleccionado
  Route::post('/borrarsolicitud', 'UsuarioController@borrarSolicitud');
  
  //Muestra las solicitudes de un usuario
  Route::get('/versolicitudes/{id}', 'UsuarioController@VerSolicitudesUsuario');
  //Muestra el perfil de un usuario
  Route::get('/verperfil/{id}', 'UsuarioController@verPerfilUsuario');
  Route::post('/modificarperfil', 'UsuarioController@CambiarPerfilUsuario');

  Route::post('/desconectarusuario', 'UsuarioController@DesconectarUsuario');
});
    //Se crea un usuario
  Route::post('/registro', 'UsuarioController@create');
  //Se logea un usuario
  Route::post('/login', 'UsuarioController@loginUsuario');
  
});