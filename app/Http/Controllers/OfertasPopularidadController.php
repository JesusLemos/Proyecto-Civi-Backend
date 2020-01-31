<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertasPopularidadController extends Controller
{
    public function ofertasOrdenadas()
    {
        try{
        $ofertasOrdenadas = DB::table('oferta_trabajos')
            ->orderBy('popularidad', 'desc')
            ->get();
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return ($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
          }

        return $ofertasOrdenadas;
    }
}
