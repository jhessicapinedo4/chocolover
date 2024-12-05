<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClienteAuthController extends Controller
{
  public function showRegistrationForm()
  {
    return view('cliente.register');
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'direccion' => 'nullable|string', // Ahora no es obligatorio
      'telefono' => 'nullable|string|max:9',  // Ahora no es obligatorio
      'dni' => 'nullable|string|max:8',  // Ahora no es obligatorio
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'cliente'
    ]);

    // Crear cliente, asegurándose de que solo se pasen los valores presentes
    $clienteData = [
      'user_id' => $user->id,
      'direccion' => $request->direccion ?? null,  // Puede ser null
      'telefono' => $request->telefono ?? null,    // Puede ser null
      'dni' => $request->dni ?? null,              // Puede ser null
    ];

    // Filtramos valores nulos
    $clienteData = array_filter($clienteData, fn($value) => !is_null($value));

    $cliente = Cliente::create($clienteData);

    Auth::login($user);

    return redirect()->route('cliente.dashboard');
  }

  public function showLoginForm()
  {
    return view('cliente.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $credentials['role'] = 'cliente';

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->route('cliente.dashboard');
    }

    return back()->withErrors([
      'email' => 'Las credenciales no coinciden.',
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }

  
}
