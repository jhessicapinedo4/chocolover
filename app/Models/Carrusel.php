<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrusel extends Model
{
  use HasFactory;

  // Especificamos el nombre exacto de la tabla
  protected $table = 'carrusels';

  // Definimos los campos que se pueden asignar de forma masiva
  protected $fillable = [
    'imagen',
    'descripcion',
    'orden',
  ];
}
