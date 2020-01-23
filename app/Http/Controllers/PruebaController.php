<?php

namespace App\Http\Controllers;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    //
    public function getAll()
    {

        $prueba=DB::table('usuarios')
        ->join('solicitudes', 'solicitudes.id_usuario', '=', 'usuarios.id')
        ->join('oferta_trabajos', 'solicitudes.id_oferta_trabajo', '=', 'oferta_trabajos.id')
        ->join('empresas', 'oferta_trabajos.id_empresa', '=', 'empresas.id')
        ->get();


        ///////////////////
        // $prueba= DB::table('oferta_trabajos')
       
        // ->rightJoin('empresas', 'oferta_trabajos.id_empresa', '=', 'empresas.id')
        
        // ->join('ciudads', 'oferta_trabajos.id_ciudad', '=', 'ciudads.id'    )
        // // ->select('*', 'empresas.nombre as nombre_empresa', 'oferta_trabajos.descripcion as oferta', 'empresas.descripcion as oferta2')
        // ->where('oferta_trabajos.id', '=', 1)
        // ->get();
        
        return $prueba;
     
    }
}
