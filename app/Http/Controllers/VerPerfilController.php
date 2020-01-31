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
        ->get();
        return $perfil;
    }
    public function verPerfilUsuario($id){
        $perfil=DB::table('usuarios')
        ->where('usuarios.id', '=', $id)
        ->get();
        return $perfil;
    }
}
