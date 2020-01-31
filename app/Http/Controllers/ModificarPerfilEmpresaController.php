<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModificarPerfilEmpresaController extends Controller
{
    public function CambiarPerfilEmpresa(Request $request){

        $empresa=$request->input();
        $comprobarEmpresa=DB::table('empresas')
        ->where('id', '=', $empresa{'id'})
        ->get();


        if(count($comprobarEmpresa) === 1 ){
        DB::table('empresas')
        ->where('id', '=', $empresa{'id'})
        ->update(['nif' =>$empresa{'nif'},
        'contrasenia' =>encrypt($empresa{'contrasenia'}),
        'foto' =>$empresa{'foto'},
        'nombre_empresa' =>$empresa{'nombre_empresa'},
        'descripcion_empresa' =>$empresa{'descripcion_empresa'},
        'id_categoria' =>$empresa{'id_categoria'}]);
            return response('Se ha modificado el perfil correctamente');
        }else{

            return response('Se ha producido un error');
        }
    }
}
