<?php

namespace App\Http\Controllers;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerPerfilController extends Controller
{
    
    public function verPerfilEmpresa($id){
        $perfil=DB::table('empresas')
        ->where('empresas.id', '=', $id)
        ->join('oferta_trabajos', 'oferta_trabajos.id_empresa', '=','empresas.id')
        ->select('empresas.id as empresas_num_empresa'
        ,'empresas.nif as empresas_nif'
        ,'empresas.foto as empresas_foto'
        ,'empresas.nombre_empresa as empresas_nombre'
        ,'empresas.descripcion_empresa as empresas_descripcion'
        ,'empresas.id_categoria as empresas_categoria'
        ,'empresas.remember_token as empresas_token'
        ,'oferta_trabajos.titulo as oferta_trabajos_titulo'
        ,'oferta_trabajos.descripcion_oferta as oferta_trabajos_descripcion'
        ,'oferta_trabajos.popularidad as oferta_trabajos_popularidad'
        ,'oferta_trabajos.anuncio as oferta_trabajos_anuncio'
        ,'oferta_trabajos.id_empresa as oferta_trabajos_num_empresa'
        ,'oferta_trabajos.id_ciudad as oferta_trabajos_ciudad'
        ,'oferta_trabajos.fecha_publicacion as oferta_trabajos_fecha_publicacion'
        )
        ->get();
        return $perfil;
    }
}
