<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Producto; // Asegúrate de importar tu modelo

class ProductoList extends Component
{
  public $productos;

  // El constructor recibe los productos de la base de datos
  public function __construct()
  {
    $this->productos = Producto::all(); // Aquí traes todos los productos
  }

  public function render()
  {
    return view('components.producto-list');
  }
}
