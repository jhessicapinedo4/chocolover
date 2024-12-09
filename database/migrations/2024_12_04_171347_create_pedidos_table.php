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
    Schema::create('pedidos', function (Blueprint $table) {
      $table->id();
      $table->foreignId('cliente_id')->constrained('cliente')->onDelete('cascade'); 
      $table->enum('tipo_envio', ['recoger', 'domicilio']);
      $table->date('fecha_entrega');
      $table->string('hora_entrega');
      $table->decimal('monto_total', 10, 2);
      $table->text('mensaje')->nullable();
      $table->string('estado')->default('pendiente');
      // Aquí se agrega el campo mercado_pago_preference_id después de "estado"
      $table->string('mercado_pago_preference_id')->nullable();
      $table->boolean('pedido_enviado')->default(false);
      $table->foreignId('cupon_id')->nullable()->constrained('cupones')->onDelete('set null');
      $table->timestamps();
    });
  
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pedidos');
  }
};
