<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      // Redirigir según el rol
      return match (Auth::user()->role) {
        'admin' => redirect()->intended('/admin/dashboard'),
        'cliente' => redirect()->intended('/cliente/dashboard'),
        default => redirect('/')
      };
    }

    return back()->withErrors([
      'email' => 'Credenciales incorrectas.',
    ]);
  }
}
