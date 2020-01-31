<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModificarPerfilUsuarioController extends Controller
{
    public function CambiarPerfilUsuario(Request $request){

        $usuario=$request->input();
        $comprobarUsuario=DB::table('usuarios')
        ->where('id', '=', $usuario{'id'})
        ->get();

        
        if(count($comprobarUsuario) === 1){
        DB::table('usuarios')
        ->where('id', '=', $usuario{'id'})
        ->update(['nombre_usuario' =>$usuario{'nombre_usuario'},
        'apellido' =>$usuario{'apellido'},
        'contrasenia' =>encrypt($usuario{'contrasenia'}),
        'dni' =>$usuario{'dni'},
        'descripcion' =>$usuario{'descripcion'},
        'telefono' =>$usuario{'telefono'},
        'foto' =>$usuario{'foto'},
        'fecha_nacimiento' =>$usuario{'fecha_nacimiento'}]);
            return response('Se ha modificado el perfil correctamente');
        }else{

            return response('Se ha producido un error');
        }
        // return $usuario;
    }
}
