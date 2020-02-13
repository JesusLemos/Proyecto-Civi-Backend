<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfertaTrabajo extends Model
{
    //
    // public function usuarios(){
    //     return $this->belongsToMany('App\Usuario', );
    // }
    
    protected $fillable = [
        'titulo',
        'salario', 
        'descripcion_oferta', 
        'popularidad', 
        'anuncio', 
        'id_empresa', 
        'id_categoria', 
        'id_ciudad', 
        'fecha_publicacion',
        'created_at',
        'updated_at',
        'visible_usuario',
        'visible_empresa'
    ];
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
