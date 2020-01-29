<?php

namespace App;
use App\Categoria_trabajo;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //

    protected $fillable = [
        'nif',
        'email',
        'contrasenia', 
        'foto', 
        'descripcion_empresa', 
        'nombre_empresa', 
        'id_categoria', 
        'remember_token',
    ];
   // protected $table='categoria_trabajos';
    public function categoria_trabajo(){
        return $this->hasOne('App\CategoriaTrabajo', 'id', 'id_categoria');
    }
}
