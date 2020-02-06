<?php
use Illuminate\Http\Request;
use App\Http\Controllers\PruebaController;
Route::group(['middleware'=>['cors']], function (){
  //Registro, Login, Logout, Perfil, Modificar Perfil, Crear Ofertas
  Route::group(['middleware'=>['tokenEmpresa']], function (){
    //Crea ofertas por parte de la empresa
  Route::post('/crearoferta', 'EmpresaController@CrearOferta');
    //Ver todas las solicitudes por parte de la empresa
  Route::get('/versolicitudes/{id}', 'EmpresaController@VerSolicitudesEmpresas');
  Route::get('/verofertas/{id}', 'EmpresaController@VerOfertasTrabajo');
  //ver perfil de la empresa
  Route::get('/verperfil/{id}', 'EmpresaController@verPerfilEmpresa');
  //Acepta o rechaza solicitudes
  Route::post('/cambiarsolicitud', 'EmpresaController@AdministrarSolicitud');
  Route::post('/modificarperfil', 'EmpresaController@CambiarPerfilEmpresa');
  Route::post('/borrarsolicitud', 'EmpresaController@borrarSolicitud');
  Route::post('/borrarofertatrabajo', 'EmpresaController@borrarOfertaTrabajo');
});
  //Desconectar Empresa
Route::post('/desconectarempresa', 'EmpresaController@DesconectarEmpresa');
  //Registra una empresa
  Route::post('/registro', 'EmpresaController@create');
  //Conectarse con una empresa
  Route::post('/login', 'EmpresaController@loginEmpresa');
  
});