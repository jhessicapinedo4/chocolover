<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
  protected $fillable = [
    'nombre',
    'descripcion',
    'ingredientes',
    'preparacion',
    'imagen',
    'mensaje_final'
  ];
}
