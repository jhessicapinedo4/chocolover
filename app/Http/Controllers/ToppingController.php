<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $toppings = Topping::when($search, function ($query, $search) {
      $query->where('nombre', 'like', "%{$search}%")
      ->orWhere('descripcion', 'like', "%{$search}%");
    })->paginate(10);

    return view('Admin.toppings.index', compact('toppings'));
  }


  /**
   * Mostrar el formulario para crear un nuevo topping.
   */
  public function create()
  {
    return view('Admin.toppings.create');
  }

  /**
   * Almacenar un nuevo topping.
   */
  public function store(Request $request)
  {
    // Validar la información del formulario
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'descripcion' => 'nullable|string|max:500',
    ]);

    // Crear el topping
    Topping::create($data);

    return redirect()->route('toppings.index')->with('success', 'Topping creado exitosamente.');
  }

  /**
   * Mostrar el formulario de edición para un topping específico.
   */
  public function edit(Topping $topping)
  {
    return view('Admin.toppings.edit', compact('topping'));
  }


  public function show(Topping $topping)
  {
    //
  }
  /**
   * Actualizar un topping específico.
   */
  public function update(Request $request, Topping $topping)
  {
    // Validar los datos del formulario
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'descripcion' => 'nullable|string|max:500',
    ]);

    // Actualizar el topping
    $topping->update($data);

    return redirect()->route('toppings.index')->with('success', 'Topping actualizado exitosamente.');
  }

  /**
   * Eliminar un topping específico.
   */
  public function destroy(Topping $topping)
  {
    $topping->delete();

    return redirect()->route('toppings.index')->with('success', 'Topping eliminado exitosamente.');
  }
}
