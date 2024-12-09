<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Producto;

use App\Models\Categoria;

class CartaController extends Controller
{
  public function index()
  {
    // Obtener productos activos
    $productos = Producto::where('estado', true)->get();

    $categorias = Categoria::where('estado', true)->get();
    
    return view('cliente.productos', compact('productos', 'categorias'));
  }


}
