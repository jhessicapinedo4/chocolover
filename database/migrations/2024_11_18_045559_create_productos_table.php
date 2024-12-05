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
    Schema::create('productos', function (Blueprint $table) {
      $table->id();
      $table->foreignId('categoria_id')->constrained()->onDelete('cascade'); // Relación con Categorías
      $table->string('nombre');
      $table->text('descripcion');
      $table->decimal('precio', 8, 2); // Precio base (puede ser el tamaño más pequeño)
      $table->string('imagen');
      $table->boolean('personalizable')->default(false); // Indica si es personalizable
      $table->string('slug')->unique(); // URL amigable
      $table->boolean('estado')->default(true); // Activo/Inactivo
      $table->boolean('popular')->default(false); // Indica si el producto es popular
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('productos');
  }
};
