<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EliminarOfertaTrabajoEmpresaController extends Controller
{
    public function borrarOfertaTrabajo(Request $request){
        $body=$request->input();
        $comprobarSolicitud=DB::table('oferta_trabajos')
        ->where('id', '=', $body{'id'})
        ->where('id_empresa', '=', $body{'id_empresa'})
        ->get();
        if(count($comprobarSolicitud) === 1){
            $comprobarSolicitud=DB::table('oferta_trabajos')
            ->where('id', '=', $body{'id'})
            ->where('id_empresa', '=', $body{'id_empresa'})
            ->update(['visible_empresa' => 0, 'visible_usuario'=> 0]);
            return response('Se ha borrado correctamente');
        }else{

            return response(count($comprobarSolicitud));
        }
        // return $comprobarSolicitud;
    }
}
