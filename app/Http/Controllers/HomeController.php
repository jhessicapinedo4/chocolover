<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Carrusel;
use App\Models\Producto;

class HomeController extends Controller
{
  public function index()
  {
    // Recuperas todas las categorías activas
    $categorias = Categoria::where('estado', true)->get();

    // Recuperas todas las imágenes del carrusel
    $carruseles = Carrusel::all();

    $productosPopulares = Producto::where('estado', true)  // Filtramos solo productos activos
    ->where('popular', true) // Filtramos solo productos populares
    ->get();


    // Pasas ambas variables a la vista
    return view('home', compact('categorias',
      'carruseles',
      'productosPopulares'
    ));
  }
}
