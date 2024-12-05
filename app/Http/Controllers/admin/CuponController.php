<?php

namespace App\Http\Controllers\admin;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CuponController extends Controller
{

  public function index()
  {
    // Paginando los cupones con 10 por página
    $cupones = Cupon::paginate(10);

    return view('Admin.cupones.index', compact('cupones'));
  }


  // Crear un cupón (solo puede ser realizado por el administrador)
  public function create()
  {
    return view('Admin.cupones.create');
  }

  public function store(Request $request)
  {
    // Validación de los datos del formulario
    $request->validate([
      'codigo_cupon' => 'required|unique:cupones,codigo_cupon',
      'descripcion' => 'required|string|max:250',
      'descuento' => 'required|numeric|min:0',
      'fecha_expiracion' => 'required|date|after_or_equal:fecha_inicio',
      'estado' => 'nullable|boolean',
      'uso_maximo' => 'nullable|integer|min:1',
    ]);

    // Asignamos la fecha de inicio a la fecha actual si no está especificada
    $data = $request->all();
    $data['fecha_inicio'] = $data['fecha_inicio'] ?? now(); // Usa la fecha actual si no se proporciona

    Cupon::create($data);

    return redirect()->route('cupones.index')->with('success', 'Cupón creado con éxito.');
  }



  // Editar un cupón (solo puede ser realizado por el administrador)
  public function edit($id)
  {
    $cupon = Cupon::findOrFail($id);

    // Verifica si las fechas ya están en formato Carbon, si no, conviértelas
    $cupon->fecha_inicio = $cupon->fecha_inicio ? \Carbon\Carbon::parse($cupon->fecha_inicio)->toDateString() : null;
    $cupon->fecha_expiracion = $cupon->fecha_expiracion ? \Carbon\Carbon::parse($cupon->fecha_expiracion)->toDateString() : null;

    return view('Admin.cupones.edit', compact('cupon'));
  }

  public function destroy($id)
  {
    // Buscar el usuario por su ID
    $cupon = Cupon::findOrFail($id); // Si no lo encuentra, lanza una excepción

    // Eliminar al usuario
    $cupon->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('cupones.index')->with('success', 'El cupon ha sido eliminado correctamente.');
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'codigo_cupon' => 'required|unique:cupones,codigo_cupon,' . $id,
      'descripcion' => 'required|string|max:250',
      'descuento' => 'required|numeric|min:0',
      'fecha_inicio' => 'required|date',
      'fecha_expiracion' => 'required|date|after_or_equal:fecha_inicio',
      'estado' => 'nullable|boolean',
      'uso_maximo' => 'nullable|integer|min:1',
    ]);

    $cupon = Cupon::findOrFail($id);
    $cupon->update([
      'codigo_cupon' => $request->codigo_cupon,
      'descripcion' => $request->descripcion,
      'descuento' => $request->descuento,
      'fecha_inicio' => $request->fecha_inicio,
      'fecha_expiracion' => $request->fecha_expiracion,
      'uso_maximo' => $request->uso_maximo ?? null,
      'estado' => $request->estado ?? false,
    ]);

    return redirect()->route('cupones.index')->with('success', 'Cupón actualizado con éxito.');
  }

  // Desactivar un cupón
  public function deactivate($id)
  {
    $cupon = Cupon::findOrFail($id);
    $cupon->update(['estado' => false]);

    return redirect()->route('cupones.index')->with('success', 'Cupón desactivado.');
  }

  // Activar un cupón
  public function activate($id)
  {
    $cupon = Cupon::findOrFail($id);
    $cupon->update(['estado' => true]);

    return redirect()->route('cupones.index')->with('success', 'Cupón activado.');
  }

  // Usar el cupón por un cliente registrado
  public function useCupon(Request $request)
  {
    // Validar que el usuario esté autenticado
    if (!Auth::check()) {
      return redirect()->route('login')->with('error', 'Debes estar registrado para usar un cupón.');
    }

    // Validar que el código del cupón esté correcto
    $cupon = Cupon::where('codigo_cupon', $request->codigo_cupon)
      ->where('estado', true) // Asegurarse de que el cupón esté activo
      ->where('fecha_inicio', '<=', now())
      ->where('fecha_expiracion', '>=', now())
      ->first();

    if (!$cupon) {
      return redirect()->back()->with('error', 'El cupón no es válido o ha expirado.');
    }

    // Lógica para aplicar el descuento (esto depende de tu sistema de carrito, por ejemplo)
    return redirect()->back()->with('success', 'Cupón aplicado correctamente.');
  }
}
