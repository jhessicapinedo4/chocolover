<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombre',
    'descripcion',
  ];

  // Relación muchos a muchos con Productos


  public function productos()
  {
    return $this->belongsToMany(Producto::class, 'producto_toppings')->withTimestamps();
  }



  
}
