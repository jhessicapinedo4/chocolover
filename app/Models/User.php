<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
  use HasFactory;
  use Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'role'
  ];

  protected $hidden = [
    'password',
    'remember_token'
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function cliente()
  {
    return $this->hasOne(Cliente::class);
  }


  
  public function isAdmin()
  {
    return $this->role === 'admin';
  }

  public function isCliente()
  {
    return $this->role === 'cliente';
  }




}
