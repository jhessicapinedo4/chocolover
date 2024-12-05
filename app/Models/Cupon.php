<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
  use HasFactory;

  protected $table = 'cupones';
  protected $dates = ['fecha_inicio', 'fecha_expiracion'];

  protected $fillable = [
    'codigo_cupon',
    'descripcion',
    'descuento',
    'fecha_inicio',
    'fecha_expiracion',
    'uso_maximo',
    'estado',
  ];
}

