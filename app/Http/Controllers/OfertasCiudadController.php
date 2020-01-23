<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OfertasCiudadController extends Controller
{
    public function ofertasCiudades()
    {
        $ofertasPorCiudad = DB::table('oferta_trabajos')
            ->join('ciudads', 'oferta_trabajos.id_ciudad', '=', 'ciudads.id')
            ->orderBy('ciudads.nombre')
            ->get();

        return $ofertasPorCiudad;
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
