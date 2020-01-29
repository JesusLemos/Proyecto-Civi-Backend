<?php

namespace App\Http\Controllers;
use App\Empresa;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerSolicitudesController extends Controller
{
    //
    public function VerSolicitudesEmpresas($id){
       
        $TodasLasSolicitudes= DB::table('solicitudes')
        ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
        ->join('usuarios', 'usuarios.id', '=', 'solicitudes.id_usuario' )
        ->where('oferta_trabajos.id_empresa', '=', $id)
         ->select('solicitudes.id as solicitudes_num_solicitud'
         ,'solicitudes.id_usuario as solicitudes_usuario'
         ,'solicitudes.id_oferta_trabajo as solicitudes_id_oferta_trabajo'
         ,'solicitudes.estado as solicitudes_estado'
         ,'oferta_trabajos.titulo as oferta_trabajos_titulo'
         ,'oferta_trabajos.descripcion_oferta as oferta_trabajos_descripcion'
         ,'oferta_trabajos.popularidad as oferta_trabajos_popularidad'
         ,'oferta_trabajos.anuncio as oferta_trabajos_anuncio'
         ,'oferta_trabajos.id_empresa as oferta_trabajos_num_empresa'
         ,'oferta_trabajos.id_categoria as oferta_trabajos_categoria'
         ,'oferta_trabajos.id_ciudad as oferta_trabajos_ciudad'
         ,'oferta_trabajos.fecha_publicacion as oferta_trabajos_fecha_publicacion'
         ,'usuarios.nombre_usuario as usuarios_nombre'
         ,'usuarios.apellido as usuarios_apellido'
         ,'usuarios.descripcion as usuarios_descripcion'
         ,'usuarios.telefono as usuarios_telefono'
         ,'usuarios.direccion as usuarios_direccion'
         ,'usuarios.foto as usuarios_foto'
         ,'usuarios.fecha_nacimiento as usuarios_fecha_nacimiento'
         ,'usuarios.remember_token as usuarios_token')
        ->get();
        return $TodasLasSolicitudes;
    }
    public function VerSolicitudesUsuario($id){
        $TodasLasSolicitudes= DB::table('solicitudes')
        ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
        ->join('usuarios', 'usuarios.id', '=', 'solicitudes.id_usuario' )
        ->where('solicitudes.id_usuario', '=', $id)
         ->select('solicitudes.id as solicitudes_num_solicitud'
         ,'solicitudes.id_usuario as solicitudes_usuario'
         ,'solicitudes.id_oferta_trabajo as solicitudes_id_oferta_trabajo'
         ,'solicitudes.estado as solicitudes_estado'
         ,'oferta_trabajos.titulo as oferta_trabajos_titulo'
         ,'oferta_trabajos.descripcion_oferta as oferta_trabajos_descripcion'
         ,'oferta_trabajos.popularidad as oferta_trabajos_popularidad'
         ,'oferta_trabajos.anuncio as oferta_trabajos_anuncio'
         ,'oferta_trabajos.id_empresa as oferta_trabajos_num_empresa'
         ,'oferta_trabajos.id_categoria as oferta_trabajos_categoria'
         ,'oferta_trabajos.id_ciudad as oferta_trabajos_ciudad'
         ,'oferta_trabajos.fecha_publicacion as oferta_trabajos_fecha_publicacion'
         ,'usuarios.nombre_usuario as usuarios_nombre'
         ,'usuarios.apellido as usuarios_apellido'
         ,'usuarios.descripcion as usuarios_descripcion'
         ,'usuarios.telefono as usuarios_telefono'
         ,'usuarios.direccion as usuarios_direccion'
         ,'usuarios.foto as usuarios_foto'
         ,'usuarios.fecha_nacimiento as usuarios_fecha_nacimiento'
         ,'usuarios.remember_token as usuarios_token')
        ->get();
        return $TodasLasSolicitudes;

    }
}