<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticulosPedido;

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
    'mercado_pago_preference_id',
    'pedido_enviado',
    'cupon_id',
  ];

  public function cliente()
  {
    return $this->belongsTo(Cliente::class);
  }

  public function cupon()
  {
    return $this->belongsTo(Cupon::class);
  }

  public function articulos()
  {
    return $this->hasMany(ArticulosPedido::class);
  }

}
