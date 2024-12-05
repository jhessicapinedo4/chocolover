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
    Schema::create('articulos_pedidos', function (Blueprint $table) {
      $table->id();
      $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
      $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
      $table->foreignId('topping_id')->nullable()->constrained('toppings')->onDelete('set null');
      $table->integer('cantidad');
      $table->decimal('precio_unitario', 10, 2);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('articulos_pedidos');
  }
};
