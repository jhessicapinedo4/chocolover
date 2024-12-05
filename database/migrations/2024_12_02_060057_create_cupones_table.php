<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponesTable extends Migration
{
  /**
   * Ejecutar la migración.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cupones', function (Blueprint $table) {
      $table->id();
      $table->string('codigo_cupon', 50)->unique();
      $table->string('descripcion',250);
      $table->decimal('descuento', 5, 2);
      $table->dateTime('fecha_inicio');
      $table->dateTime('fecha_expiracion');
      $table->integer('uso_maximo')->nullable();
      $table->boolean('estado')->default(false); // Cambiado a false por defecto
      $table->timestamps();
    });
  }

  /**
   * Deshacer la migración.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cupones');
  }
}
