<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
  use HasFactory;

  // Definir los campos que pueden ser asignados masivamente

  protected $table = 'calificaciones';
  protected $fillable = [
    'cliente_id',
    'producto_id',
    'calificacion',
    'comentario',
  ];

  /**
   * Relación con el modelo Cliente.
   * Un cliente puede hacer muchas calificaciones.
   */
  public function cliente()
  {
    return $this->belongsTo(Cliente::class); // Relación inversa: Calificacion pertenece a Cliente
  }


  // En el modelo Calificacion
  public function user()
  {
    return $this->belongsTo(User::class, 'cliente_id'); // Ajusta 'cliente_id' si el nombre del campo es diferente
  }


  /**
   * Relación con el modelo Producto.
   * Un producto puede tener muchas calificaciones.
   */
  public function producto()
  {
    return $this->belongsTo(Producto::class); // Relación inversa: Calificacion pertenece a Producto
  }

  /**
   * Obtener la fecha de creación (creada por Laravel con 'created_at')
   */
  public function getFechaCalificacionAttribute()
  {
    return $this->created_at;  // Usar 'created_at' como la fecha de la calificación
  }
}
