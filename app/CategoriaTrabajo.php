<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaTrabajo extends Model
{
    
     public function categoria_trabajo(){
        return $this->belongsTo('App\CategoriaTrabajo');
    }
}

