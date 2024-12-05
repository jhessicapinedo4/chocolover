<?php

namespace App\Http\Controllers\admin;

use App\Models\Calificacion;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCalificacionController extends Controller
{
  public function index(Request $request)
  {
    // Filtro de búsqueda por nombre de cliente o nombre del producto
    $search = $request->input('search');

    $calificaciones = Calificacion::with('producto', 'cliente.user') // Cargar los datos relacionados
      ->when($search, function ($query, $search) {
        return $query->whereHas('producto', function ($q) use ($search) {
          $q->where('nombre', 'like', '%' . $search . '%');
        })
          ->orWhereHas('cliente.user', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
          });
      })
      ->paginate(10); // Paginación de 10 resultados por página

    return view('admin.calificaciones.index', compact('calificaciones'));
  }

  public function destroy($id)
  {
    // Buscar la calificación por su ID
    $calificacion = Calificacion::findOrFail($id);

    // Eliminar la calificación
    $calificacion->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.calificaciones.index')->with('success', 'Calificación eliminada con éxito');
  }
}
