<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfertasTrabajosController extends Controller
{
    //1-Ofertas popularidad, 2-Oferta todas las ciudades, 3-Oferta por ciudad
    //4- Oferta por anuncio 5-Oferta por puesto de trabajo


    //0-Filtro general de ofertas
    public function omniFiltro($omni)
    {
        try {
            $omniFiltro = DB::table('oferta_trabajos')
                ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
                ->join('categoria_trabajos', 'categoria_trabajos.id', '=', 'oferta_trabajos.id_categoria')
                ->orWhere('oferta_trabajos.titulo', 'like', '%' . $omni . '%')
                ->orWhere('ciudades.nombre', 'like', '%' . $omni . '%')
                ->orWhere('categoria_trabajos.nombre', 'like', '%' . $omni . '%')
                ->orWhere('oferta_trabajos.descripcion_oferta', 'like', '%' . $omni . '%')
                ->select(
                    'oferta_trabajos.id as oferta_trabajos_num',
                    'oferta_trabajos.titulo as oferta_trabajos_titulo',
                    'oferta_trabajos.descripcion_oferta as oferta_trabajos_descripcion',
                    'oferta_trabajos.popularidad as oferta_trabajos_popularidad',
                    'oferta_trabajos.anuncio as oferta_trabajos_anuncio',
                    'oferta_trabajos.visible_usuario as oferta_trabajos_visible_usuario',
                    'oferta_trabajos.visible_empresa as oferta_trabajos_visible_empresa',
                    'oferta_trabajos.id_empresa as oferta_trabajos_num_empresa',
                    'oferta_trabajos.id_categoria as oferta_trabajos_categoria',
                    'oferta_trabajos.id_ciudad as oferta_trabajos_ciudad',
                    'oferta_trabajos.fecha_publicacion as oferta_trabajos_fecha_publicacion',
                    'ciudades.id as ciudades_num',
                    'ciudades.nombre as ciudades_nombre',
                    'categoria_trabajos.id as categoria_trabajos_num',
                    'categoria_trabajos.nombre as categoria_trabajos_nombre'
                )
                ->get();
            return $omniFiltro;
        } catch (\Illuminate\Database\QueryException $ex) {
            return ($ex->getMessage());
        }
    }


    //1-Ofertas popularidad

    public function ofertasOrdenadas()
    {
        try {
            $ofertasOrdenadas = DB::table('oferta_trabajos')
                ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
                ->orderBy('oferta_trabajos.popularidad', 'desc')
                ->select(
                    'oferta_trabajos.id as id_oferta',
                    'oferta_trabajos.titulo as titulo',
                    'oferta_trabajos.popularidad as popularidad',
                    'oferta_trabajos.anuncio as anuncio',
                    'oferta_trabajos.id_empresa as id_empresa',
                    'oferta_trabajos.descripcion_oferta as descripcion_oferta',
                    'oferta_trabajos.fecha_publicacion as fecha_publicacion',
                    'oferta_trabajos.visible_usuario as visible_usuario',
                    'oferta_trabajos.visible_empresa as visible_empresa',
                    'ciudades.nombre as nombre'
                )
                // ->orderBy('id')
                ->get();
        } catch (\Illuminate\Database\QueryException $ex) {
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
        } catch (\Illuminate\Database\QueryException $ex) {
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

    public function ofertasAnuncios()
    {
        try {
            $ofertasAnuncios = DB::table('oferta_trabajos')
                ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
                ->where('anuncio', '=', true)
                ->get();
            return $ofertasAnuncios;
        } catch (\Illuminate\Database\QueryException $ex) {
            return ($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
        }
    }


    //5-Oferta por puesto de trabajo

    public function ofertasPuesto($puesto)
    {
        try {
            $ofertasPorPuesto = DB::table('oferta_trabajos')
                ->join('categoria_trabajos', 'categoria_trabajos.id', '=', 'oferta_trabajos.id_categoria')
                ->join('ciudades', 'oferta_trabajos.id_ciudad', '=', 'ciudades.id')
                ->where('categoria_trabajos.nombre', '=', $puesto)
                ->get();

            return $ofertasPorPuesto;
        } catch (\Illuminate\Database\QueryException $ex) {
            return ($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
        }
    }
}
