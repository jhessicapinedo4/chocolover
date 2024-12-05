<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Authenticatable
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'direccion',
    'telefono',
    'dni',
  ];

  // Relación inversa con User
  public function user()
  {
    return $this->belongsTo(User::class);
  }


}
