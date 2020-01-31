<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    // 1-Registro, 2-Conectarse, 3-Desconectarse,4-Ver perfil de empresa ,5-Crear Oferta, 
    //6-Ver Solicitudes mandado por usuarios, 7-Borrar Solicitud,8-Eliminar oferta de trabajo
    //9-Modificar perfil,10-Administrar Solicitudes de los usuarios

    //1-Registro
    public function create(Request $data)
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


            //2-Conectarse
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
            } catch (\Exception $e) {   
                return response('Ha ocurrido un error');
            }    
        }


        //3-Desconectarse
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

        //4-Ver perfil de empresa
        public function verPerfilEmpresa($id){
            $perfil=DB::table('empresas')
            ->where('empresas.id', '=', $id)
            ->get();
            return $perfil;
        }
        //5-Crear oferta de trabajo
        public function CrearOferta(Request $request){
        
            $oferta =$request->input();
            DB::table('oferta_trabajos')->insert([
                ['titulo'=>$oferta{'titulo'},
                'descripcion_oferta'=>$oferta{'descripcion_oferta'},
                'popularidad'=>$oferta{'popularidad'},
                'anuncio'=>$oferta{'anuncio'},
                'id_empresa'=>$oferta{'id_empresa'},
                'id_categoria'=>$oferta{'id_categoria'},
                'id_ciudad'=>$oferta{'id_ciudad'},
                'fecha_publicacion'=>$oferta{'fecha_publicacion'},
                'created_at'=>null,
                'updated_at'=>null]
            ]);
               
        }

        

        //6-Ver solicitudes mandado por lo usuarios
        public function VerSolicitudesEmpresas($id){
       
            $TodasLasSolicitudes= DB::table('solicitudes')
            ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
            ->join('usuarios', 'usuarios.id', '=', 'solicitudes.id_usuario' )
            ->where('oferta_trabajos.id_empresa', '=', $id)
            ->where('oferta_trabajos.visible_empresa','=', true)
            ->where('solicitudes.visible_empresa','=', true)
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
             ,'oferta_trabajos.id_empresa as oferta_trabajos_num_empresa'
             ,'oferta_trabajos.id_categoria as oferta_trabajos_categoria'
             ,'oferta_trabajos.id_ciudad as oferta_trabajos_ciudad'
             ,'oferta_trabajos.fecha_publicacion as oferta_trabajos_fecha_publicacion'
            ,'oferta_trabajos.visible_usuario as oferta_trabajos_visible_usuario'
             ,'oferta_trabajos.visible_empresa as oferta_trabajos_visible_empresa'
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

        //7-Borrar Solicitud
        public function borrarSolicitud(Request $request){
            $body=$request->input();

            $comprobarSolicitud=DB::table('solicitudes')
            ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
            ->where('solicitudes.id', '=', $body{'id'})
            ->where('oferta_trabajos.id_empresa', '=', $body{'id_empresa'})
            ->get();
            
            if(count($comprobarSolicitud) === 1 && $comprobarSolicitud[0]->estado !== "Pendiente"){
                $comprobarSolicitud=DB::table('solicitudes')
                ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
                ->where('solicitudes.id', '=', $body{'id'})
                ->where('oferta_trabajos.id_empresa', '=', $body{'id_empresa'})
                ->update(['solicitudes.visible_empresa' => 0]);
                return response('Se ha borrado correctamente');
            }else{
                return response(count($comprobarSolicitud));
            }
        }

        //8-Eliminar oferta de trabajo
        public function borrarOfertaTrabajo(Request $request){
            $body=$request->input();

            $comprobarSolicitud=DB::table('oferta_trabajos')
            ->where('id', '=', $body{'id'})
            ->where('id_empresa', '=', $body{'id_empresa'})
            ->get();

            if(count($comprobarSolicitud) === 1){
                $comprobarSolicitud=DB::table('oferta_trabajos')
                ->where('id', '=', $body{'id'})
                ->where('id_empresa', '=', $body{'id_empresa'})
                ->update(['visible_empresa' => 0, 'visible_usuario'=> 0]);
                return response('Se ha borrado correctamente');
            }else{
                return response(count($comprobarSolicitud));
            }
        }
        //9-Modificar perfil
        public function CambiarPerfilEmpresa(Request $request){

            $empresa=$request->input();
            $comprobarEmpresa=DB::table('empresas')
            ->where('id', '=', $empresa{'id'})
            ->get();
    
    
            if(count($comprobarEmpresa) === 1 ){
                DB::table('empresas')
                ->where('id', '=', $empresa{'id'})
                ->update(['nif' =>$empresa{'nif'},
                'contrasenia' =>encrypt($empresa{'contrasenia'}),
                'foto' =>$empresa{'foto'},
                'nombre_empresa' =>$empresa{'nombre_empresa'},
                'descripcion_empresa' =>$empresa{'descripcion_empresa'},
                'id_categoria' =>$empresa{'id_categoria'}]);
                return response('Se ha modificado el perfil correctamente');
            }else{
    
                return response('Se ha producido un error');
            }
        }
        
        //10-Administrar Solicitudes de los usuarios
        public function AdministrarSolicitud(Request $request){
            //id solicitud y id_empresa
            $numSolicitud = $request->input();
            $comprobarEstado=DB::table('solicitudes')
            ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
            ->where('solicitudes.id', '=', $numSolicitud{'id'})
            ->where('oferta_trabajos.id_empresa', '=', $numSolicitud{'id_empresa'})
            ->get();
            
             if($comprobarEstado[0]->estado === 'Aceptado' || $comprobarEstado[0]->estado === 'Rechazado' ){
             
            
                return response('Esta oferta ya ha sido aceptada o rechazada');
            }else{
                DB::table('solicitudes')
                ->join('oferta_trabajos', 'oferta_trabajos.id', '=', 'solicitudes.id_oferta_trabajo')
                ->where('solicitudes.id', '=', $numSolicitud{'id'})
                ->where('oferta_trabajos.id_empresa', '=', $numSolicitud{'id_empresa'})
                ->update(['estado' =>$numSolicitud{'estado'}]);
                return response('Se ha completado corretamente');
            }
                // return $comprobarEstado;
        }
}
