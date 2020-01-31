<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EliminarSolicitudEmpresaController extends Controller
{
    public function borrarSolicitud(Request $request){
        $body=$request->input();
        $comprobarSolicitud=DB::table('solicitudes')
        ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
        ->where('solicitudes.id', '=', $body{'id'})
        ->where('oferta_trabajos.id_empresa', '=', $body{'id_empresa'})
        ->get();
        if(count($comprobarSolicitud) === 1 && $comprobarSolicitud[0]->estado !== "Pendiente"){
            $comprobarSolicitud=DB::table('solicitudes')
            ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
            ->where('solicitudes.id', '=', $body{'id'})
            ->where('oferta_trabajos.id_empresa', '=', $body{'id_empresa'})
            ->update(['solicitudes.visible_empresa' => 0]);
            return response('Se ha borrado correctamente');
        }else{

            return response(count($comprobarSolicitud));
        }
        // return $comprobarSolicitud;
    }
}
