<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertasAnunciosController extends Controller
{
    //
    public function ofertasAnuncios(){
        $ofertasAnuncios= DB::table('oferta_trabajos')
        ->where('anuncio', '=', true)
        ->get();
        return $ofertasAnuncios;

    }
}
