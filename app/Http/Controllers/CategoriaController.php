<?php


namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // Obtiene el término de búsqueda desde el formulario
    $search = $request->input('name');

    // Filtra las categorías si hay un término de búsqueda
    $categorias = Categoria::when($search, function ($query, $search) {
      $query->where('nombre', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%');
    })->paginate(10); // Paginamos los resultados

    // Asegúrate de pasar la variable a la vista
    return view('Admin.categorias.index', compact('categorias'));
    
  }

  /**
   * Muestra el formulario para crear una nueva categoría.
   */
  public function create()
  {
    return view('Admin.categorias.create');
  }

  /**
   * Almacena una nueva categoría en la base de datos.
   */
  public function store(Request $request)
  {
    // Validar los datos del formulario
    $data = $request->validate([
      'nombre' => 'required|string|max:100|unique:categorias', // Asegura que el nombre sea único
      'descripcion' => 'nullable|string|max:255',
      'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validar que sea una imagen válida
    ]);

    // Manejo del archivo de imagen
    $imageName = null;
    if ($request->hasFile('imagen')) {
      $imageObject = $request->file('imagen');
      $imageExtension = $imageObject->getClientOriginalExtension();
      $imageName = time() . '.' . $imageExtension;

      // Guardar la imagen en la carpeta `public/imagenes/categorias`
      $imageObject->move(public_path('imagenes/categorias'), $imageName);
    }

    // Crear la categoría en la base de datos
    Categoria::create([
      'nombre' => $data['nombre'],
      'description' => $data['descripcion'],
      'imagen' => $imageName,
      'estado' => true, // Por defecto, activa
    ]);

    return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
  }

  /**
   * Muestra el formulario para editar una categoría.
   */
  public function edit(Categoria $categoria)
  {
    return view('Admin.categorias.edit', compact('categoria'));
  }

  // public function showForClient($slug)
  // {
  //   $categoria = Categoria::where('slug', $slug)->firstOrFail();
  //   return view('categoria.show', compact('categoria'));
  // }

  public function show(Categoria $categoria)
  {
    return view('Admin.categorias.show', [
      'categoria' => $categoria,
    ]);
  }




  /**
   * Actualiza una categoría en la base de datos.
   */
  public function update(Request $request, Categoria $categoria)
  {
    // Validar los datos del formulario
    $data = $request->validate([
      'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id, // Asegura que el nombre sea único, excepto para la categoría actual
      'description' => 'nullable|string',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
      'estado' => 'required|boolean',
    ]);

    // Manejo de la imagen
    if ($request->hasFile('imagen')) {
      // Eliminar la imagen anterior si existe
      if ($categoria->imagen && file_exists(public_path('imagenes/categorias/' . $categoria->imagen))) {
        unlink(public_path('imagenes/categorias/' . $categoria->imagen));
      }

      // Guardar la nueva imagen
      $imagen = $request->file('imagen');
      $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
      $imagen->move(public_path('imagenes/categorias'), $nombreImagen);

      // Actualizar el nombre de la imagen
      $data['imagen'] = $nombreImagen;
    }

    // Actualizar la categoría en la base de datos
    $categoria->update($data);

    return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
  }

  /**
   * Cambia el estado de una categoría a "activa".
   */
  public function activate(Categoria $categoria)
  {
    $categoria->update(['estado' => true]);
    return redirect()->route('categorias.index')->with('success', 'Categoría activada exitosamente.');
  }

  /**
   * Cambia el estado de una categoría a "inactiva".
   */
  public function deactivate(Categoria $categoria)
  {
    $categoria->update(['estado' => false]);
    return redirect()->route('categorias.index')->with('success', 'Categoría desactivada exitosamente.');
  }
}
