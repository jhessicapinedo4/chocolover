<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search'); // Obtener el término de búsqueda
    $categoria_id = $request->input('categoria_id'); // Obtener la categoría seleccionada

    // Filtrar productos por nombre y categoría
    $productos = Producto::when($search, function ($query, $search) {
      $query->where('nombre', 'like', '%' . $search . '%')
        ->orWhere('descripcion', 'like', '%' . $search . '%');
    })
    ->when($categoria_id, function ($query, $categoria_id) {
      $query->where('categoria_id', $categoria_id); // Filtrar por categoría
    })
    ->paginate(10); // Paginación de resultados

    // Obtener todas las categorías activas
    $categorias = Categoria::where('estado', true)->get();

    return view('Admin.productos.index', compact('productos'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categorias = Categoria::where('estado', true)->get();

    return view('Admin.productos.create', compact('categorias'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
    
      'categoria_id' => 'required|exists:categorias,id',
      'descripcion' => 'required|string',
      'precio' => 'required|numeric|min:0',
      'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      'estado' => 'required|boolean',
      'personalizable' => 'required|boolean',
      'popular' => 'required|boolean', // Validación para el campo 'popular'
    ]);

    if ($request->hasFile('imagen')) {
      $imagen = $request->file('imagen');
      $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
      $imagen->move(public_path('imagenes/productos'), $nombreImagen);
      $data['imagen'] = $nombreImagen;
    }

    Producto::create($data);

    return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
  }




  public function show( Producto $producto)
  {
    $producto->load('categoria');
    return view('Admin.productos.show', [
      'producto' => $producto,
      
    ]);

    
    
  }


  public function showCliente($slug)
  {
    // Buscar el producto por el slug
    $producto = Producto::with('categoria')->where('slug', $slug)->firstOrFail();
    // Pasar el producto a la vista
    return view('cliente.detallesProducto.detalles', compact('producto'));

    
  }




  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Producto $producto)
  {
    $categorias = Categoria::where('estado', true)->get();

    return view('Admin.productos.edit', compact('producto', 'categorias'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Producto $producto)
  {
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'descripcion' => 'nullable|string',
      'precio' => 'required|numeric|min:0',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
      'categoria_id' => 'required|exists:categorias,id',
      'personalizable' => 'required|boolean',
      'estado' => 'required|boolean',
      'popular' => 'required|boolean', // Validación para el campo 'popular'
    ]);

    // Actualizar imagen si se sube una nueva
    if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      $filename = time() . '.' . $file->getClientOriginalExtension();
      $file->move(public_path('imagenes/productos'), $filename);

      // Eliminar la imagen anterior si existe
      if ($producto->imagen && file_exists(public_path('imagenes/productos/' . $producto->imagen))) {
        unlink(public_path('imagenes/productos/' . $producto->imagen));
      }

      $data['imagen'] = $filename;
    }

    $data['slug'] = Str::slug($data['nombre']);
    $producto->update($data);

    return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
  }

  /**
   * Change the status of the product to active.
   */
  public function activate(Producto $producto)
  {
    $producto->update(['estado' => true]);
    return redirect()->route('productos.index')->with('success', 'Producto activado exitosamente.');
  }

  /**
   * Change the status of the product to inactive.
   */
  public function deactivate(Producto $producto)
  {
    $producto->update(['estado' => false]);
    return redirect()->route('productos.index')->with('success', 'Producto desactivado exitosamente.');
  }

  public function toppings()
  {
    $productos = Producto::all(); // Obtén todos los productos
    $toppings = Topping::all();   // Obtén todos los toppings

    return view('Admin.productos.toppings', compact('productos', 'toppings'));
  }



  public function assignToppingForm()
  {
    $productos = Producto::all();
    $toppings = Topping::all();

    return view('Admin.productos.asignar_toppings', compact('productos', 'toppings'));
  }

  public function assignTopping(Request $request)
  {
    $data = $request->validate([
      'producto_id' => 'required|exists:productos,id',
      'topping_id' => 'required|exists:toppings,id',
    ]);

    $producto = Producto::findOrFail($data['producto_id']);
    $producto->Toppings()->attach($data['topping_id']); // Relación muchos a muchos

    return redirect()->back()->with('success', 'Topping asignado al producto correctamente.');
  }



  // Mostrar productos populares
  public function productosPopulares()
  {
    $productosPopulares = Producto::where('popular', true)->paginate(10); // Obtener solo productos populares

    return view('Admin.productos.index', compact('productosPopulares'));
  }

}

