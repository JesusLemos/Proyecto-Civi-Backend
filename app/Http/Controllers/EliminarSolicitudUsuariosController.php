<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EliminarSolicitudUsuariosController extends Controller
{
    public function borrarSolicitud(Request $request){
        $body=$request->input();
        $comprobarSolicitud=DB::table('solicitudes')
        ->where('id', '=', $body{'id'})
        ->where('id_usuario', '=', $body{'id_usuario'})
        ->get();
        if(count($comprobarSolicitud) === 1 && $comprobarSolicitud[0]->estado !== "Pendiente"){
            $comprobarSolicitud=DB::table('solicitudes')
            ->where('id', '=', $body{'id'})
            ->where('id_usuario', '=', $body{'id_usuario'})
            ->update(['visible_usuario' => 0]);
            return response('Se ha borrado correctamente');
        }else{
            return response('Ha ocurrido un error');
        }
    }
}
