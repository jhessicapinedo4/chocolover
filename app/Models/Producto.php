<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Producto extends Model
{
  use HasFactory;

  protected $fillable = [
    'categoria_id',
    'nombre',
    'descripcion',
    'precio',
    'imagen',
    'personalizable',
    'slug',
    'estado',
    'popular', // Agregado
  ];

  // Relación con Categoría -- cambiar a minuscula
  public function Categoria()
  {
    return $this->belongsTo(Categoria::class);
  }

  

  // Generación del Slug antes de crear un producto
  protected static function booted()
  {
    static::creating(function ($producto) {
      $producto->slug = Str::slug($producto->nombre);
    });
  }


  // Relación con Toppings
  public function toppings()
  {
    return $this->belongsToMany(Topping::class, 'producto_toppings')->withTimestamps();
  }


  // Producto.php (Modelo)
  // Producto.php (Modelo)
  public function calificaciones()
  {
    return $this->hasMany(Calificacion::class);  // Relación de uno a muchos con Calificacion
  }


}
