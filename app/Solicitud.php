<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    public function usuario(){
        return $this->belongsToMany('App\ems', 'prueba');
    }
   


}


