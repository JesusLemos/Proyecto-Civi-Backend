<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfertaTrabajo extends Model
{
    //
    // public function usuarios(){
    //     return $this->belongsToMany('App\Usuario', );
    // }
    
   
    public function ciudad(){
         
        return $this->hasOne('App\Ciudad','id', 'id_ciudad' );

    }
    public function categoria_trabajo(){
        return $this->hasOne('App\CategoriaTrabajo', 'id', 'id_categoria');
    }
   
        public function empresa() {
            return $this->hasOne('App\Empresa', 'id', 'id_empresa');
        }

        public function solicitud(){
            return $this->belongsToMany('App\Usuario', 'solicitudes','id','id_oferta_trabajo')->withPivot('estado');
        }
}
