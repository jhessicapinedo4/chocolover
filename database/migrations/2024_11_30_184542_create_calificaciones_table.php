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
    Schema::create('calificaciones', function (Blueprint $table) {
      $table->id();
      $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade'); // Relación con clientes
      $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
      $table->unsignedTinyInteger('calificacion'); // Calificación entre 1 y 5
      $table->text('comentario')->nullable(); // Comentario opcional
      $table->timestamps(); // Laravel gestiona created_at y updated_at
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('calificaciones');
  }
};
