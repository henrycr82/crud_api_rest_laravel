<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    //tabla
    protected $table = 'directorios';

    //campos editables
    protected $fillable = ['nombre','direccion','telefono','foto'];

    //para ocultar campos cuando listamos
    protected $hidden = ['created_at','updated_at'];
}
