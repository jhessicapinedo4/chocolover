<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;  // Importar Str

class Categoria extends Model
{
  use HasFactory;

  // Nombre de la tabla (opcional si sigue la convención)
  protected $table = 'categorias';

  // Campos que se pueden asignar masivamente
  protected $fillable = ['nombre', 'description', 'imagen', 'estado', 'slug'];

  /**
   * Relación: una categoría tiene muchos productos.
   */
  public function productos()
  {
    return $this->hasMany(Producto::class);
  }

  /**
   * Desactivar la categoría y sus productos asociados.
   */
  public function deactivateWithProducts()
  {
    // Iniciar una transacción para asegurar la integridad de los datos
    DB::transaction(function () {
      // Desactivar todos los productos asociados
      $this->productos()->update(['estado' => false]);

      // Desactivar la categoría
      $this->update(['estado' => false]);
    });
  }

  /**
   * Activar la categoría y sus productos asociados.
   */
  public function activateWithProducts()
  {
    DB::transaction(function () {
      // Activar todos los productos asociados
      $this->productos()->update(['estado' => true]);

      // Activar la categoría
      $this->update(['estado' => true]);
    });
  }

  /**
   * Generar el slug automáticamente antes de guardar el modelo.
   */
  public static function boot()
  {
    parent::boot();

    // Generar el slug antes de guardar
    static::saving(function ($categoria) {
      if (empty($categoria->slug)) {
        $categoria->slug = Str::slug($categoria->nombre);
      }
    });
  }
}

