<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    public function solicitud(){
        return $this->belongsToMany('App\OfertaTrabajo', 'solicitudes','id', 'id_usuario')->withPivot('estado');
    }
}
