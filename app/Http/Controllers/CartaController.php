<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Producto;


class CartaController extends Controller
{
  public function index()
  {
    // Obtener productos activos
    $productos = Producto::where('estado', true)->get();

    return view('cliente.productos', compact('productos'));
  }
}
