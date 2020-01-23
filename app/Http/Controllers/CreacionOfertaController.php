<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CreacionOfertaController extends Controller
{
    //

    public function CrearOferta(Request $request){
        
        $oferta =$request->input();
        DB::table('oferta_trabajos')->insert([
            ['titulo'=>$oferta{'titulo'},
            'descripcion_oferta'=>$oferta{'descripcion_oferta'},
            'popularidad'=>$oferta{'popularidad'},
            'anuncio'=>$oferta{'anuncio'},
            'id_empresa'=>$oferta{'id_empresa'},
            'id_categoria'=>$oferta{'id_categoria'},
            'id_ciudad'=>$oferta{'id_ciudad'},
            'fecha_publicacion'=>$oferta{'fecha_publicacion'},
            'created_at'=>null,
            'updated_at'=>null]
        ]);
            // return $oferta{''};
    }
}
