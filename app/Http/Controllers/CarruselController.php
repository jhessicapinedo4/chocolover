<?php

namespace App\Http\Controllers;

use App\Models\Carrusel;
use Illuminate\Http\Request;

class CarruselController extends Controller
{
  /**
   * Muestra el listado de carruseles.
   */
  public function index(Request $request)
  {
    // Obtiene el término de búsqueda desde el formulario
    $search = $request->input('descripcion');

    // Filtra los carruseles si hay un término de búsqueda
    $carruseles = Carrusel::when($search, function ($query, $search) {
      $query->where('descripcion', 'like', '%' . $search . '%');
    })->paginate(10); // Paginamos los resultados

    // Asegúrate de pasar la variable a la vista
    return view('Admin.carrusel.index', compact('carruseles'));
  }

  /**
   * Muestra el formulario para crear un nuevo carrusel.
   */
  public function create()
  {
    return view('Admin.carrusel.create');
  }

  /**
   * Almacena un nuevo carrusel en la base de datos.
   */
  public function store(Request $request)
  {
    // Validar los datos del formulario
    $data = $request->validate([
      'descripcion' => 'required|string|max:255',
      'orden' => 'required|integer',
      'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validar que sea una imagen válida
    ]);

    // Manejo del archivo de imagen
    $imageName = null;
    if ($request->hasFile('imagen')) {
      $imageObject = $request->file('imagen');
      $imageExtension = $imageObject->getClientOriginalExtension();
      $imageName = time() . '.' . $imageExtension;

      // Guardar la imagen en la carpeta `public/imagenes/carrusel`
      $imageObject->move(public_path('imagenes/carrusel'), $imageName);
    }

    // Crear el carrusel en la base de datos
    Carrusel::create([
      'descripcion' => $data['descripcion'],
      'orden' => $data['orden'],
      'imagen' => $imageName,
    ]);

    return redirect()->route('carrusel.index')->with('success', 'Carrusel agregado exitosamente.');
  }


  public function show(Carrusel $carrusel)
  {
    return view('Admin.carrusel.show', [
      'carrusel' => $carrusel,
    ]);
  }
  /**
   * Muestra el formulario para editar un carrusel.
   */
  public function edit(Carrusel $carrusel)
  {
    return view('Admin.carrusel.edit', compact('carrusel'));
  }

  /**
   * Actualiza un carrusel en la base de datos.
   */
  public function update(Request $request, Carrusel $carrusel)
  {
    // Validar los datos del formulario
    $data = $request->validate([
      'descripcion' => 'required|string|max:255',
      'orden' => 'required|integer',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Manejo de la imagen
    if ($request->hasFile('imagen')) {
      // Eliminar la imagen anterior si existe
      if ($carrusel->imagen && file_exists(public_path('imagenes/carrusel/' . $carrusel->imagen))) {
        unlink(public_path('imagenes/carrusel/' . $carrusel->imagen));
      }

      // Guardar la nueva imagen
      $image = $request->file('imagen');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('imagenes/carrusel'), $imageName);

      // Actualizar el nombre de la imagen
      $data['imagen'] = $imageName;
    }

    // Actualizar el carrusel en la base de datos
    $carrusel->update($data);

    return redirect()->route('carrusel.index')->with('success', 'Carrusel actualizado correctamente.');
  }

  /**
   * Elimina un carrusel de la base de datos.
   */
  public function destroy(Carrusel $carrusel)
  {
    // Eliminar la imagen si existe
    if ($carrusel->imagen && file_exists(public_path('imagenes/carrusel/' . $carrusel->imagen))) {
      unlink(public_path('imagenes/carrusel/' . $carrusel->imagen));
    }

    // Eliminar el registro del carrusel
    $carrusel->delete();

    return redirect()->route('carrusel.index')->with('success', 'Carrusel eliminado correctamente.');
  }

  
}
