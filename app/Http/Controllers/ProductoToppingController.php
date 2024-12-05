<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Producto_Topping;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductoToppingController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');

    $productos = Producto::with('toppings')
      ->when($search, function ($query, $search) {
        $query->where('nombre', 'like', '%' . $search . '%')
          ->orWhereHas('toppings', function ($q) use ($search) {
            $q->where('nombre', 'like', '%' . $search . '%');
          });
      })
      ->paginate(10);

    return view('Admin.toppings_productos.index', compact('productos'));
  }


}
