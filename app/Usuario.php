<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Usuario as Authenticatable;

class Usuario extends Model
{
    //
    protected $fillable = [
        'nombre_usuario',
        'apellido',
        'email',
        'dni',
        'descripcion', 
        'telefono', 
        'direccion', 
        'foto', 
        'contrasenia', 
        'fecha_nacimiento',
        'remember_token',
    ];

    public function solicitud(){
        return $this->belongsToMany('App\OfertaTrabajo', 'solicitudes','id', 'id_usuario')->withPivot('estado');
    }
}
