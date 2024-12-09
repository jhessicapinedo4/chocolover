<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticulosPedido extends Model
{
  use HasFactory;

  protected $fillable = [
    'pedido_id',
    'producto_id',
    'topping_id',
    'cantidad',
    'precio_unitario',
  ];

  public function pedido()
  {
    return $this->belongsTo(Pedidos::class);
  }

  public function producto()
  {
    return $this->belongsTo(Producto::class);
  }

  public function topping()
  {
    return $this->belongsTo(Topping::class);
  }
}
