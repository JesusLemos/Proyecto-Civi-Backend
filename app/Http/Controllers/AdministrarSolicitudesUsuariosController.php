<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministrarSolicitudesUsuariosController extends Controller
{
    public function AdministrarSolicitud(Request $request){
        //id solicitud y id_usuario
        $numSolicitud = $request->input();
        $comprobarEstado=DB::table('solicitudes')
        ->where('id', '=', $numSolicitud{'id'})
        ->where('id_usuario', '=', $numSolicitud{'id_usuario'})
        ->get();
        
        if($comprobarEstado[0]->estado === 'Aceptado' || $comprobarEstado[0]->estado === 'Rechazado' ){
         
        
            return response('Esta oferta ya ha sido aceptada o rechazada');
        }else{
            DB::table('solicitudes')
            ->where('id', '=', $numSolicitud{'id'})
            ->where('id_usuario', '=', $numSolicitud{'id_usuario'})
            ->update(['estado' =>'Rechazado']);
            return response('Se ha completado corretamente');
        }
            // return $comprobarEstado;
    }
}
