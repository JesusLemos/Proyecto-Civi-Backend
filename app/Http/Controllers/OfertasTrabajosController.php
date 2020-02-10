<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfertasTrabajosController extends Controller
{
    //1-Ofertas popularidad, 2-Oferta todas las ciudades, 3-Oferta por ciudad
    //4- Oferta por anuncio 5-Oferta por puesto de trabajo

    //1-Ofertas popularidad

    public function ofertasOrdenadas()
    {
        try{
        $ofertasOrdenadas = DB::table('oferta_trabajos')
        ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
            ->orderBy('oferta_trabajos.popularidad', 'desc')
            ->select('oferta_trabajos.id as id_oferta' 
            , 'oferta_trabajos.titulo as titulo'
            , 'oferta_trabajos.popularidad as popularidad'
            , 'oferta_trabajos.anuncio as anuncio'
            ,'oferta_trabajos.id_empresa as id_empresa'
            
            , 'oferta_trabajos.descripcion_oferta as descripcion_oferta'
            , 'oferta_trabajos.fecha_publicacion as fecha_publicacion'
            ,  'oferta_trabajos.visible_usuario as visible_usuario'
            , 'oferta_trabajos.visible_empresa as visible_empresa'
            , 'ciudades.nombre as nombre')
            // ->orderBy('id')
            ->get();
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return ($ex->getMessage()); 
          }

        return $ofertasOrdenadas;
    }

    //2-Oferta todas las ciudades
    public function ofertasCiudades()
    {
        try {
            $ofertasPorCiudad = DB::table('oferta_trabajos')
            ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
            ->orderBy('ciudades.nombre')
            ->get();

        return $ofertasPorCiudad;
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return ($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
          }
       
    }

    //3-Oferta por ciudad

    public function ofertasCiudad($nombreciudad)
    {
        $ofertasPorCiudad = DB::table('oferta_trabajos')
            ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
            ->orderBy('ciudades.nombre')
            ->where('ciudades.nombre', '=', $nombreciudad)
            ->get();

        return $ofertasPorCiudad;
    }

    //4-Oferta por anuncio

        public function ofertasAnuncios(){
            try{
            $ofertasAnuncios= DB::table('oferta_trabajos')
            ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
            ->where('anuncio', '=', true)
            ->get();
            return $ofertasAnuncios;
    
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return ($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
          }
        }
    

    //5-Oferta por puesto de trabajo

    public function ofertasPuesto($puesto)
    {
        try{
        $ofertasPorPuesto = DB::table('oferta_trabajos')
            ->join('categoria_trabajos', 'categoria_trabajos.id', '=', 'oferta_trabajos.id_categoria')
            ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
            ->where('categoria_trabajos.nombre', '=', $puesto)
            ->get();

        return $ofertasPorPuesto;
    }
    catch(\Illuminate\Database\QueryException $ex){ 
        return ($ex->getMessage()); 
        // Note any method of class PDOException can be called on $ex.
      }
    }

 
}
