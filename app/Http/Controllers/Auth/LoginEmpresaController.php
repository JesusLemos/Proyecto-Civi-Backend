<?php

namespace App\Http\Controllers\Auth;
use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginEmpresaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginEmpresa(Request $request){
       
       
       
        try {
          
            $body =$request->input();
            $comprobarEmpresaExistente = DB::table('empresas')
            ->where('email', '=', $body{'email'})
            ->get();
        if(count($comprobarEmpresaExistente) === 0){
            return response('Contrasenia o correo invalido');
        } 
            
    
    
            $comprobarcontrasenia=decrypt($comprobarEmpresaExistente[0]->contrasenia);
    
             $contrasenia= ($body{'contrasenia'});
    
    
           if($comprobarcontrasenia === $contrasenia){
               $generarToken=encrypt(str_random(15));
               $actualizarToken= DB::table('empresas')
               ->where('email', '=', $body{'email'})
                ->update(['remember_token'=>$generarToken]);
               return 'Te has conectado correctamente';
           }else{
               return  response('Contrasenia o correo invalido');
           }
          
            //code...
        } catch (\Exception $e) {
            //throw $th;
            return response('Ha ocurrido un error');
        }
         
    // return $comprobarcontrasenia;
        
    }
}
