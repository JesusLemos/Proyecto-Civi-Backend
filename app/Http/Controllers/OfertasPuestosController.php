<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertasPuestosController extends Controller
{
    public function ofertasPuesto($puesto)
    {
        $ofertasPorPuesto = DB::table('oferta_trabajos')
            ->join('categoria_trabajos', 'categoria_trabajos.id', '=', 'oferta_trabajos.id_categoria')
            ->where('categoria_trabajos.nombre', '=', $puesto)
            ->get();

        return $ofertasPorPuesto;
    }
}
