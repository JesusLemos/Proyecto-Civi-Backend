<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Crear Ofertas
  Route::group(['middleware'=>['tokenEmpresa']], function (){
    //Crea ofertas por parte de la empresa
  Route::post('/crearoferta', 'CreacionOfertaController@CrearOferta');
    //Ver todas las solicitudes por parte de la empresa
  Route::get('/versolicitudes/{id}', 'VerSolicitudesController@VerSolicitudesEmpresas');
  //ver perfil de la empresa
  Route::get('/verperfil/{id}', 'VerPerfilController@verPerfilEmpresa');
  //Acepta o rechaza solicitudes
  Route::post('/cambiarsolicitud', 'AdministrarSolicitudesEmpresaController@AdministrarSolicitud');
  Route::post('/modificarperfil', 'ModificarPerfilEmpresaController@CambiarPerfilEmpresa');
  Route::post('/borrarsolicitud', 'EliminarSolicitudEmpresa Controller@borrarSolicitud');
  });
  //Registra una empresa
  Route::post('/registro', 'Auth\RegisterEmpresaController@create');
  //Conectarse con una empresa
  Route::post('/login', 'Auth\LoginEmpresaController@loginEmpresa');
  
});