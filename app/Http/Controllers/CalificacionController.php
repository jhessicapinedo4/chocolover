<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
  /**
   * Almacenar una nueva calificación en la base de datos.
   */

  // Calificacion.php (Modelo)
  protected $table = 'calificaciones';  // Asegúrate de que este es el nombre correcto de la tabla


  public function store(Request $request)
  {
    // Validación de los datos
    $request->validate([
      'producto_id' => 'required|exists:productos,id',
      'calificacion' => 'required|integer|between:1,5',
      'comentario' => 'nullable|string|max:255',
    ]);

    // Obtener al usuario autenticado
    $usuario = Auth::user();

    // Obtener el cliente asociado
    $cliente = $usuario->cliente;

    // Si no existe un cliente, retornar error
    if (!$cliente) {
      return redirect()->back()->with('error', 'No se encontró un cliente asociado al usuario.');
    }

    // Crear la calificación
    $calificacion = Calificacion::create([
      'cliente_id' => $cliente->id,
      'producto_id' => $request->producto_id,
      'calificacion' => $request->calificacion,
      'comentario' => $request->comentario,
    ]);

    // Redirigir al mismo producto, con un mensaje de éxito
    return redirect()->back()->with('success', '¡Tu calificación se ha guardado correctamente!');
  }









  /**
   * Mostrar todas las calificaciones de un producto específico.
   */
  public function showProductRatings($producto_id)
  {
    // Obtener todas las calificaciones del producto, junto con los clientes
    $calificaciones = Calificacion::where('producto_id', $producto_id)
      ->with('cliente') // Cargar los clientes asociados a cada calificación
      ->get();

    return response()->json([
      'producto_id' => $producto_id,
      'calificaciones' => $calificaciones
    ]);
  }
}
