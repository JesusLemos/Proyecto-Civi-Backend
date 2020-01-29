<?php

namespace App\Http\Controllers\Auth;

use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
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
//     protected function validator(Request $data)
//     {
//         try{

     
//         $v = \Validator::make($data->all(), [
//         //  $prueba=$data->validate([
//             'nombre_usuario' => 'required|string|max:25',
//             'apellido' => 'required|string|max:25',
//             'email' => 'required|string|email|max:255|unique:usuarios',
//             'contrasenia' => 'required|min:8|string',
//             'dni' => 'required|string|max:255',
//             'descripcion' => 'required|string|max:255',
//             'telefono' => 'required|string|max:255',
//             'direccion' => 'required|string|max:255',
//             'foto' => 'required|string|max:255',
//             'fecha_nacimiento' => 'required|date',
//             'remember_token' =>  'string|max:255',
           
//         ]);
//     // return reponse($v);
       
//      }catch (Exception $e) {
//         echo 'Excepción capturada: ',  $e->getMessage(), "\n";
//     }
// }

public function rules(){
    return[
        'nombre_usuario' => 'required|string|max:25',
        'apellido' => 'required|string|max:25',
        'email' => 'required|string|email|max:255|unique:usuarios',
        'contrasenia' => 'required|min:8|string',
        'dni' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'foto' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        // 'remember_token' =>  'string|max:255',
    ];
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @body  array  $data
     * @return \App\Usuario
     */
    protected function create(Request $data)
    {
        // try {

        //     $validator = \Validator::make($data->all(), [
        //         'nombre_usuario' => ['required' , 'string','max:25', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'apellido' => ['required' , 'string','max:25', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'email' => ['required','string','email','max:255','unique:usuarios', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'contrasenia' => ['required','min:8','string', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'dni' => ['required','string','max:255', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'descripcion' => ['required','string','max:255', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'telefono' => ['required','string','max:255', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'direccion' => ['required','string','max:255', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'foto' => ['required','string','max:255', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }],
        //         'fecha_nacimiento' => ['required','date', function($attribute, $value, $file){
        //             if($value==='foo'){
        //                 $fail($attribute.'is invalid');
        //             }
        //         }]
        //     ]);
        try{
            $data->validate([
                'nombre_usuario' => 'required|string|max:25',
                'apellido' => 'required|string|max:25',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'contrasenia' => 'required|min:8|string',
                'dni' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'foto' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                // 'remember_token' =>  'string|max:255',
            ]);
            return Usuario::create([
                'nombre_usuario'=>$data{"nombre_usuario"},
                'apellido'=>$data{"apellido"},
                'email'=>$data{"email"},
                'dni'=>$data{"dni"},
                'descripcion'=>$data{"descripcion"},
                'telefono'=>$data{"telefono"},
                'direccion'=>$data{"direccion"},
                'foto'=>$data{"foto"},
                'contrasenia'=>$data{"contrasenia"},
                'fecha_nacimiento'=>$data{"fecha_nacimiento"},
                'remember_token'=>$data{"remember_token"}
            ]
    
             );
        } catch (\Exception $e) {
          return $e->getMessage();
        //    return ['code'=>$e->getCode(),
        //    'file'=>$e->getFile(),
        //    'line'=>$e->getLine(),
        //    'message'=>$e->getMessage(),
        //    'trace'=>$e->getTrace()];
        // }catch(PDOException $e){

        // }
      
    }
}
}
