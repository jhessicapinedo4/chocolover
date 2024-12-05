<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
  use HasFactory;

  protected $fillable = [
    'cliente_id',
    'tipo_envio',
    'fecha_entrega',
    'hora_entrega',
    'monto_total',
    'mensaje',
    'estado',
    'pedido_enviado',
    'cupon_id',
    
  ];

  // Relación con Cliente
  public function cliente()
  {
    return $this->belongsTo(Cliente::class);
  }

  // Relación con Cupon
  public function cupon()
  {
    return $this->belongsTo(Cupon::class);
  }

  // Relación con ArticulosPedidos
  public function articulosPedidos()
  {
    return $this->hasMany(ArticulosPedido::class);
  }

}
