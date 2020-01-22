<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    public function oferta_trabajos(){
        return $this->belongsToMany('App\Oferta_Trabajo');
    }
}
