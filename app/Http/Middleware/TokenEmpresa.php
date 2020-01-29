<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;  
use Closure;

class TokenEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token  = $_SERVER['HTTP_AUTHORIZATION'];
        $comprobarEmpresa=DB::table('empresas')
        ->where('remember_token', '=', $token)
        ->get();
        if(count($comprobarEmpresa) === 0){
            return response('Algo fallo');
        }else{
            return $next($request);

           }
    }
}
