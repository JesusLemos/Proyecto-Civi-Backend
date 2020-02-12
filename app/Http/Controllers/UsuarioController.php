<?php

namespace App\Http\Controllers;
use App\Usuario;
use App\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    // 1-Registro, 2-Conectarse, 3-Desconectarse,4-Ver perfil de usuario , 
    //5-Ver Solicitudes mandadas, 6-Borrar Solicitud,7-Modificar perfil 8-Solicitar Oferta
    //9- Rechazar Solicitud
    
  
  
    // 1-Registro
    public function create(Request $data)
    {
     
        try{

            $comprobarUsuarioExistente = DB::table('usuarios')
            ->where('email', '=', $data{'email'})
            ->get();
           
            if(count($comprobarUsuarioExistente) !== 0){
                return ['Mensaje'=>'El email ya existe'];
            }
            if(strlen (  $data{'contrasenia'} ) <8){
                return ['Mensaje'=>'La contraseña tiene que ser mayor de 8 caracteres'];
            }
            

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
                'contrasenia'=>encrypt($data{"contrasenia"}),
                'fecha_nacimiento'=>$data{"fecha_nacimiento"},  
           
                ]
             );
        } catch (\Exception $e) {
          return ['Mensaje'=>'Dato invalido'];

    }
}
    //2-Conectarse
    public function loginUsuario(Request $request){
       
        try {
          
            $body = $request->input();
            $prueba = $body{'email'};
            // return $body;
            $comprobarUsuarioExistente = DB::table('usuarios')
            ->where('email', '=', $body{'email'})
            ->get();
       
            if(count($comprobarUsuarioExistente) === 0){ 
            return response('Contrasenia o correo invalido');
        } 

            $comprobarcontrasenia=decrypt($comprobarUsuarioExistente[0]->contrasenia);
    
             $contrasenia= ($body{'contrasenia'});
    
    
           if($comprobarcontrasenia == json_decode($contrasenia, true)){
              
            $generarToken=encrypt(str_random(15));
               $actualizarToken= DB::table('usuarios')
               ->where('email', '=', $body{'email'})
                ->update(['remember_token'=>$generarToken]);

                $usuarioToken = DB::table('usuarios')
                ->where('email', '=', $body{'email'})
                ->get();
               return $usuarioToken;
          
            }else{
              
            return  ['Mensaje'=>'Contrasenia o correo invalido'];
          
        }

        } catch (\Exception $e) {
            return ['Mensaje'=>'Ha ocurrido un error'];
        }
    }

    //3-Desconectarse
    public function DesconectarUsuario(Request $request){
        $body = $request->input();
        $comprobarUsuario = DB::table('usuarios')
        ->where('id', '=', $body{'id'})
        ->get();
        if(count($comprobarUsuario) ===1){
            $comprobarUsuario = DB::table('usuarios')
            ->where('id', '=', $body{'id'})
            ->update(['remember_token'=>null]);
            return ['Mensaje'=>'Te has desconectado correctamente'];
        }else{
            return ['Mensaje'=>'Ha ocurrido un error'];
        }
        // return $comprobarUsuario;
    }
    //4-Ver perfil de usuario 
    public function verPerfilUsuario($id){
        $perfil=DB::table('usuarios')
        ->where('usuarios.id', '=', $id)
        ->get();
        return $perfil;
    }

    //5-Ver Solicitudes
    public function VerSolicitudesUsuario($id){
        $TodasLasSolicitudes= DB::table('solicitudes')
        ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
        ->join('usuarios', 'usuarios.id', '=', 'solicitudes.id_usuario' )
        ->where('solicitudes.id_usuario', '=', $id)
        // ->where('oferta_trabajos.visible_usuario','=', true)
        ->where('solicitudes.visible_usuario','=', true)
         ->select('solicitudes.id as solicitudes_num_solicitud'
         ,'solicitudes.id_usuario as solicitudes_usuario'
         ,'solicitudes.id_oferta_trabajo as solicitudes_id_oferta_trabajo'
         ,'solicitudes.estado as solicitudes_estado'
         ,'solicitudes.visible_empresa as solicitudes_visible_empresa'
         ,'solicitudes.visible_usuario as solicitudes_visible_usuario'
         ,'oferta_trabajos.id as oferta_trabajos_num'
         ,'oferta_trabajos.titulo as oferta_trabajos_titulo'
         ,'oferta_trabajos.descripcion_oferta as oferta_trabajos_descripcion'
         ,'oferta_trabajos.popularidad as oferta_trabajos_popularidad'
         ,'oferta_trabajos.anuncio as oferta_trabajos_anuncio'
         ,'oferta_trabajos.visible_usuario as oferta_trabajos_visible_usuario'
         ,'oferta_trabajos.visible_empresa as oferta_trabajos_visible_empresa'
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

        if(count($TodasLasSolicitudes)!==0){

            return $TodasLasSolicitudes;
        }else{
            return ['Mensaje'=>'No se ha encontrado ninguna solicitud'];
        }

    }

    //6-Borrar Solicitud
    public function borrarSolicitud(Request $request){
        $body=$request->input();
        $comprobarSolicitud=DB::table('solicitudes')
        ->where('id', '=', $body{'id'})
        ->where('id_usuario', '=', $body{'id_usuario'})
        ->get();
        if(count($comprobarSolicitud) === 1 && $comprobarSolicitud[0]->estado !== "Pendiente"){
            $comprobarSolicitud=DB::table('solicitudes')
            ->where('id', '=', $body{'id'})
            ->where('id_usuario', '=', $body{'id_usuario'})
            ->update(['visible_usuario' => 0]);
            return ['Mensaje' =>'Se ha borrado correctamente'];
        }else{
            return ['Mensaje'=>'Ha ocurrido un error'];
        }
    }

    //7-Modificar perfil
    public function CambiarPerfilUsuario(Request $request){

        $usuario=$request->input();
        $comprobarUsuario=DB::table('usuarios')
        ->where('id', '=', $usuario{'id'})
        ->get();

        
        if(count($comprobarUsuario) === 1){
        DB::table('usuarios')
        ->where('id', '=', $usuario{'id'})
        ->update(['nombre_usuario' =>$usuario{'nombre_usuario'},
        'apellido' =>$usuario{'apellido'},
        'dni' =>$usuario{'dni'},
        'descripcion' =>$usuario{'descripcion'},
        'telefono' =>$usuario{'telefono'},
        'foto' =>$usuario{'foto'},
        'fecha_nacimiento' =>$usuario{'fecha_nacimiento'}]);
            return ['Mensaje'=>'Se ha modificado el perfil correctamente'];
        }else{

            return ['Mensaje'=>'Se ha producido un error']  ;
        }
      
    }

    //8-Solicitar Oferta
    public function solicitarOferta(Request $request){
        
        $body = $request->input();
        // $header = $request->header('authorization');
        $comprobarPuestoTrabajo= DB::table('oferta_trabajos')->where('id', '=', $body{'id_oferta_trabajo'})->get();
       $comprobarUsuarioExistente= DB::table('usuarios')->where('id', '=', $body{'id_usuario'})->get();
       if(count($comprobarPuestoTrabajo)===1){
       
        if(count($comprobarUsuarioExistente)===1){

            // DB::table('oferta_trabajos')->where('id', '=', $body{'id_oferta_trabajo'})->update(['visible_usuario' =>0]);
                Solicitud::create([ 
                    'id_usuario'=>$comprobarUsuarioExistente[0]->id,
                    'id_oferta_trabajo'=>$comprobarPuestoTrabajo[0]->id,
                    'estado'=>"Pendiente",
                    'visible_usuario'=> 1,
                    'visible_empresa'=> 1
                                ]);
                                return ['Mensaje'=>'Se ha solicitado la oferta de trabajo correctamente'];
                  }      
               }
            }

            //9- Rechazar Solicitud
            public function AdministrarSolicitud(Request $request){
                //id solicitud y id_usuario
                $numSolicitud = $request->input();
                $comprobarEstado=DB::table('solicitudes')
                ->where('id', '=', $numSolicitud{'id'})
                ->where('id_usuario', '=', $numSolicitud{'id_usuario'})
                ->get();
                
                if($comprobarEstado[0]->estado === 'Aceptado' || $comprobarEstado[0]->estado === 'Rechazado' ){
                 
                
                    return ['Mensaje'=>'Esta oferta ya ha sido aceptada o rechazada'];
                }else{
                    DB::table('solicitudes')
                    ->where('id', '=', $numSolicitud{'id'})
                    ->where('id_usuario', '=', $numSolicitud{'id_usuario'})
                    ->update(['estado' =>'Rechazado']);
                    return ['Mensaje'=>'Se ha completado corretamente'];
                }
                    // return $comprobarEstado;
            }

}
