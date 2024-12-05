<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('carrusels', function (Blueprint $table) {
      $table->id();
      $table->string('imagen');  // Ruta o nombre del archivo de la imagen
      $table->string('descripcion');  // Texto alternativo corto
      $table->integer('orden')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('carrusels');
  }
};
