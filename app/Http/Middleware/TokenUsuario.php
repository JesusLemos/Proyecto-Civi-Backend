<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;  
use Closure;

class TokenUsuario
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
        $comprobarUsuario=DB::table('usuarios')
        ->where('remember_token', '=', $token)
        ->get();

        // $prueba= $request->input();
        // $token= $request->header('Authorization', $value);

        if(count($comprobarUsuario) === 0){
            return response('Algo fallo');
        }else{
            return $next($request);

           }
        // return response($token);
    }
}
