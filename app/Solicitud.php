<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = [
        'id_usuario', 'id_oferta_trabajo', 'estado', 'visible_usuario', 'visible_empresa'
    ];
    //
     protected $table = 'solicitudes';
    public function usuarios(){
        return $this->belongsToMany('App\Usuario');
    }
   


}


