<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertasAnunciosController extends Controller
{
    //
    public function ofertasAnuncios(){
        try{
        $ofertasAnuncios= DB::table('oferta_trabajos')
        ->where('anuncio', '=', true)
        ->get();
        return $ofertasAnuncios;

    }
    catch(\Illuminate\Database\QueryException $ex){ 
        return ($ex->getMessage()); 
        // Note any method of class PDOException can be called on $ex.
      }
    }
    
}
