<?php

namespace App\Http\Controllers\Auth;

use App\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterEmpresaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @body  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */





    /**
     * Create a new user instance after a valid registration.
     *
     * @body  array  $data
     * @return \App\Empresa
     */
    protected function create(Request $data)
    {
    
        try{
            $comprobarCategoria=DB::table('categoria_trabajos')
            ->where('id', '=', $data{'id_categoria'})
            ->get();

            if(count($comprobarCategoria) ===0){
                //  return response('No existe esa categoria');
                var_dump(count($comprobarCategoria));
            }

            $data->validate([
                'nif' => 'required|string|max:25',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'contrasenia' => 'required|min:8|string',
                'foto' => 'required|string|max:255',
                'nombre_empresa' => 'required|string|max:255',
                'descripcion_empresa' => 'required|string|max:255'
                
            ]);
            return Empresa::create([
                'nif'=>$data{"nif"},
                'email'=>$data{"email"},
                'contrasenia'=>encrypt($data{"contrasenia"}),
                'foto'=>$data{"foto"},
                'nombre_empresa'=>$data{"nombre_empresa"},
                'descripcion_empresa'=>$data{"descripcion_empresa"},
                'id_categoria'=>$data{"id_categoria"},
               
            ]
    
             );
           
        } catch (\Exception $e) {
          return $e->getMessage();
    
      
    }
}
}
