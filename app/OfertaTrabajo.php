<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta_Trabajo extends Model
{
    //
    public function usuarios(){
        return $this->belongsToMany('App\Usuario', );
    }
}
