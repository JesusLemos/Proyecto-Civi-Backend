<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertasPopularidadController extends Controller
{
    public function ofertasOrdenadas()
    {
        $ofertasOrdenadas = DB::table('oferta_trabajos')
            ->orderBy('popularidad', 'desc')
            ->get();

        return $ofertasOrdenadas;
    }
}
