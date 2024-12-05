<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ImagenesCarrusel extends Model
{
  use HasFactory;

  protected $fillable = ['imagen', 'texto_alternativo', 'active'];
}
