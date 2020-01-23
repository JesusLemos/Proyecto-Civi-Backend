<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Services\PayUService\Exception;

class OfertasCiudadsController extends Controller
{
    public function ofertasCiudades()
    {
        try {
            $ofertasPorCiudad = DB::table('oferta_trabajos')
            ->join('ciudads', 'oferta_trabajos.id_ciudad', '=', 'ciudads.id')
            ->orderBy('ciudads.nombre')
            ->get();

        return $ofertasPorCiudad;
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return ($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
          }
       
    }

    public function ofertasCiudad($nombreciudad)
    {
        $ofertasPorCiudad = DB::table('oferta_trabajos')
            ->join('ciudads', 'oferta_trabajos.id_ciudad', '=', 'ciudads.id')
            ->orderBy('ciudads.nombre')
            ->where('ciudads.nombre', '=', $nombreciudad)
            ->get();

        return $ofertasPorCiudad;
    }
}
