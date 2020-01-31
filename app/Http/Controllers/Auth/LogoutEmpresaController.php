<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LogoutEmpresaController extends Controller
{
    public function DesconectarEmpresa(Request $request){
        $body = $request->input();
        $comprobarEmpresa = DB::table('empresas')
        ->where('id', '=', $body{'id'})
        ->get();
        if(count($comprobarEmpresa) ===1){
            $comprobarEmpresa = DB::table('empresas')
            ->where('id', '=', $body{'id'})
            ->update(['remember_token'=>null]);
            return response('Te has desconectado correctamente');
        }else{
            return response('Ha ocurrido un error');
        }
        return $comprobarEmpresa;
    }
}
