<?php

namespace App\Http\Controllers;
use App\OfertaTrabajo;
use App\Solicitud;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitarOfertaController extends Controller
{
    //
    public function solicitarOferta(Request $request){
        
        $body = $request->input();
        // $header = $request->header('authorization');
        $comprobarPuestoTrabajo= DB::table('oferta_trabajos')->where('id', '=', $body{'id_oferta_trabajo'})->get();
       $comprobarUsuarioExistente= DB::table('usuarios')->where('id', '=', $body{'id_usuario'})->get();
       if($comprobarPuestoTrabajo){
       
        if($comprobarUsuarioExistente){

            
                return Solicitud::create([ 
                    'id_usuario'=>$comprobarUsuarioExistente[0]->id,
                    'id_oferta_trabajo'=>$comprobarPuestoTrabajo[0]->id,
                    'estado'=>"Pendiente"
                                ]);
                  }      
               }
            }
      
    }

