<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
  /**
   * Mostrar el listado de recetas con filtro por nombre.
   */
  public function index(Request $request)
  {
    $search = $request->input('search'); // Obtener el término de búsqueda

    // Filtrar recetas por nombre o descripción
    $recetas = Receta::when($search, function ($query, $search) {
      $query->where('nombre', 'like', '%' . $search . '%')
        ->orWhere('descripcion', 'like', '%' . $search . '%');
    })
      ->paginate(10); // Paginación de resultados

    return view('Admin.recetas.index', compact('recetas'));
  }

  /**
   * Mostrar el formulario para crear una nueva receta.
   */
  public function create()
  {
    return view('Admin.recetas.create');
  }

  /**
   * Guardar una nueva receta en la base de datos.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'descripcion' => 'required|string',
      'ingredientes' => 'required|string',
      'preparacion' => 'required|string',
      'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      'mensaje_final' => 'required|string',
    ]);

    if ($request->hasFile('imagen')) {
      $imagen = $request->file('imagen');
      $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
      $imagen->move(public_path('imagenes/recetas'), $nombreImagen);
      $data['imagen'] = $nombreImagen;
    }

    Receta::create($data);

    return redirect()->route('recetas.index')->with('success', 'Receta agregada correctamente.');
  }

  /**
   * Mostrar los detalles de una receta.
   */
  public function show(Receta $receta)
  {
    return view('Admin.recetas.show', compact('receta'));
  }

  /**
   * Mostrar el formulario para editar una receta existente.
   */
  public function edit(Receta $receta)
  {
    return view('Admin.recetas.edit', compact('receta'));
  }

  /**
   * Actualizar una receta existente en la base de datos.
   */
  public function update(Request $request, Receta $receta)
  {
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'descripcion' => 'required|string',
      'ingredientes' => 'required|string',
      'preparacion' => 'required|string',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
      'mensaje_final' => 'required|string',
    ]);

    if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      $filename = time() . '.' . $file->getClientOriginalExtension();
      $file->move(public_path('imagenes/recetas'), $filename);

      // Eliminar la imagen anterior si existe
      if ($receta->imagen && file_exists(public_path('imagenes/recetas/' . $receta->imagen))) {
        unlink(public_path('imagenes/recetas/' . $receta->imagen));
      }

      $data['imagen'] = $filename;
    }

    $receta->update($data);

    return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente.');
  }

  /**
   * Eliminar una receta existente.
   */
  public function destroy(Receta $receta)
  {
    // Eliminar la imagen asociada si existe
    if ($receta->imagen && file_exists(public_path('imagenes/recetas/' . $receta->imagen))) {
      unlink(public_path('imagenes/recetas/' . $receta->imagen));
    }

    $receta->delete();

    return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente.');
  }







  public function indexCliente(Request $request)
  {
    $search = $request->input('search'); // Obtener el término de búsqueda

    // Filtrar recetas por nombre o descripción
    $recetas = Receta::when($search, function ($query, $search) {
      $query->where('nombre', 'like', '%' . $search . '%')
      ->orWhere('descripcion', 'like', '%' . $search . '%');
    })
      ->paginate(10); // Paginación de resultados

    return view('cliente.recetas.index', compact('recetas'));
  }

  /**
   * Mostrar el detalle de una receta.
   */
  public function showCliente($id)
  {
    $receta = Receta::findOrFail($id);

    // Convertir la cadena de ingredientes en un array
    $ingredientes = explode(',', $receta->ingredientes);

    // Si la preparación es un texto con saltos de línea, convertirlo en un array
    $receta->preparacion = explode("\n", $receta->preparacion);

    return view('cliente.recetas.show', compact('receta', 'ingredientes'));
  }
}
