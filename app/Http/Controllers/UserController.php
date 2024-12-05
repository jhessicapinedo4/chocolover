<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;

class UserController extends Controller
{
  public function index(Request $request)
  {
    // Obtener el término de búsqueda
    $search = $request->input('search');

    // Realizar la búsqueda y la paginación de los usuarios
    $usuarios = User::when($search, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%');
    })->with('cliente') // Cargar los datos relacionados con cliente
      ->paginate(10); // Paginación de 10 usuarios por página



    // Pasar la variable $usuarios a la vista
    return view('Admin.users.index', compact('usuarios'));
  }


  public function create()
  {
    return view('Admin.users.create');
  }

  public function store(Request $request)
  {
    // Validación de los datos del usuario
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:8|confirmed', // confirmación de contraseña
      'role' => 'nullable|string|in:cliente,admin', // Asegurando que el role sea uno válido
    ]);

    // Crear el usuario
    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role ,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'El usuario ha sido creado correctamente.');
  }

  public function destroy($id)
  {
    // Buscar el usuario por su ID
    $usuario = User::findOrFail($id); // Si no lo encuentra, lanza una excepción

    // Eliminar al usuario
    $usuario->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'El usuario ha sido eliminado correctamente.');
  }


  public function show($id)
  {
    // Buscar el usuario por su ID y cargar la relación 'cliente' si existe
    $usuario = User::with('cliente')->findOrFail($id);

    // Pasar el usuario a la vista 'show'
    return view('Admin.users.show', compact('usuario'));
  }

}
