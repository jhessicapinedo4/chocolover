<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Topping extends Model
{

  use HasFactory;
  protected $table = 'Producto_Topping';

  protected $fillable = [
    'producto_id',
    'topping_id',
  ];
}
