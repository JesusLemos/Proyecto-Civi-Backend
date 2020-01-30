<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministrarSolicitudesEmpresaController extends Controller
{
     public function AdministrarSolicitud(Request $request){
        //id solicitud y id_empresa
        $numSolicitud = $request->input();
        $comprobarEstado=DB::table('solicitudes')
        ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
        ->where('solicitudes.id', '=', $numSolicitud{'id'})
        ->where('oferta_trabajos.id_empresa', '=', $numSolicitud{'id_empresa'})
        ->get();
        
         if($comprobarEstado[0]->estado === 'Aceptado' || $comprobarEstado[0]->estado === 'Rechazado' ){
         
        
            return response('Esta oferta ya ha sido aceptada o rechazada');
        }else{
            DB::table('solicitudes')
            ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
            ->where('solicitudes.id', '=', $numSolicitud{'id'})
            ->where('oferta_trabajos.id_empresa', '=', $numSolicitud{'id_empresa'})
            ->update(['estado' =>'Rechazado']);
            return response('Se ha completado corretamente');
        }
            // return $comprobarEstado;
    }
}
