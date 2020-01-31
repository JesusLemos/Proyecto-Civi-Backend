<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutUsuarioController extends Controller
{
    public function DesconectarUsuario(Request $request){
        $body = $request->input();
        $comprobarUsuario = DB::table('usuarios')
        ->where('id', '=', $body{'id'})
        ->get();
        if(count($comprobarUsuario) ===1){
            $comprobarUsuario = DB::table('usuarios')
            ->where('id', '=', $body{'id'})
            ->update(['remember_token'=>null]);
            return response('Te has desconectado correctamente');
        }else{
            return response('Ha ocurrido un error');
        }
        return $comprobarUsuario;
    }
}
