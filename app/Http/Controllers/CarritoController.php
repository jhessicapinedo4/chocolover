<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cupon;

class CarritoController extends Controller
{
  public function agregarProducto(Request $request)
  {
    $producto = Producto::find($request->id);
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$request->id])) {
      $carrito[$request->id]['cantidad'] += $request->input('quantity', 1);
    } else {
      $carrito[$request->id] = [
        "nombre" => $producto->nombre,
        "cantidad" => $request->input('quantity', 1),
        "precio" => $producto->precio,
        "imagen" => $producto->imagen
      ];
    }

    session()->put('carrito', $carrito);

    // Total de productos
    $totalProductos = array_reduce($carrito, function ($carry, $item) {
      return $carry + $item['cantidad'];
    }, 0);

    return response()->json([
      'totalProductos' => $totalProductos,
      'carrito' => $carrito
    ]);
  }

  public function actualizarCantidad(Request $request)
  {
    $carrito = session()->get('carrito', 'pedido', 'detalles');

    if ($request->cantidad <= 0) {
      return $this->quitarProducto($request);
    }

    if (isset($carrito[$request->id])) {
      $carrito[$request->id]['cantidad'] = $request->cantidad;
      session()->put('carrito', $carrito);
    }

    // Total de productos
    $totalProductos = array_reduce($carrito, function ($carry, $item) {
      return $carry + $item['cantidad'];
    }, 0);

    if ($request->ajax()) {
      return response()->json([
        'totalProductos' => $totalProductos,
        'carrito' => $carrito
      ]);
    }

    return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada correctamente.');
  }

  public function quitarProducto(Request $request)
  {
    $carrito = session()->get('carrito');

    if (isset($carrito[$request->id])) {
      unset($carrito[$request->id]);
      session()->put('carrito', $carrito);
    }

    // Total de productos
    $totalProductos = array_reduce($carrito, function ($carry, $item) {
      return $carry + $item['cantidad'];
    }, 0);

    if ($request->ajax()) {
      return response()->json([
        'totalProductos' => $totalProductos,
        'carrito' => $carrito
      ]);
    }

    return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
  }

  public function aplicarCupon(Request $request)
  {
    // Verificar si ya existe un cupón aplicado
    if (session()->has('cupon_aplicado')) {
      return response()->json([
        'success' => false,
        'mensaje' => 'Ya has aplicado un cupón anteriormente'
      ]);
    }

    // Buscar cupón
    $cupon = Cupon::where('codigo_cupon', $request->codigo_cupon)
      ->where('estado', true)
      ->where('fecha_inicio', '<=', now())
      ->where('fecha_expiracion', '>=', now())
      ->first();

    // Validaciones del cupón
    if (!$cupon) {
      return response()->json([
        'success' => false,
        'mensaje' => 'Cupón inválido o expirado'
      ]);
    }

    $carrito = session()->get('carrito', []);

    // Validar que haya productos en el carrito
    if (empty($carrito)) {
      return response()->json([
        'success' => false,
        'mensaje' => 'El carrito está vacío'
      ]);
    }

    // Calcular total sin descuento
    $totalOriginal = array_reduce($carrito, function ($carry, $item) {
      return $carry + ($item['precio'] * $item['cantidad']);
    }, 0);

    // Calcular descuento
    $descuento = $totalOriginal * ($cupon->descuento / 100);

    // Guardar cupón en sesión
    session()->put('cupon_aplicado', [
      'codigo' => $cupon->codigo_cupon,
      'descuento' => $descuento,
      'porcentaje' => $cupon->descuento,
      'total_original' => $totalOriginal
    ]);

    return response()->json([
      'success' => true,
      'total_original' => $totalOriginal,
      'descuento' => $descuento,
      'codigoCupon' => $cupon->codigo_cupon
    ]);
  }

  public function mostrarCarrito()
  {
    $carrito = session()->get('carrito', []);
    $cuponAplicado = session()->get('cupon_aplicado', null);

    // Total sin descuento
    $total = array_reduce($carrito, function ($carry, $item) {
      return $carry + ($item['precio'] * $item['cantidad']);
    }, 0);

    // Si el carrito está vacío, eliminar el cupón (si está aplicado)
    if ($total == 0) {
      session()->forget('cupon_aplicado');
      $cuponAplicado = null;
    }

    // Total con descuento (si hay cupón aplicado)
    $totalFinal = $total;
    if ($cuponAplicado) {
      $totalFinal -= $cuponAplicado['descuento'];
    }

    return view('cliente.carrito', [
      'carrito' => $carrito,
      'total' => $total,
      'totalFinal' => $totalFinal,
      'cuponAplicado' => $cuponAplicado
    ]);
  }

  public function removerCupon(Request $request)
  {
    if (session()->has('cupon_aplicado')) {
      session()->forget('cupon_aplicado');

      if ($request->ajax()) {
        return response()->json([
          'success' => true,
          'mensaje' => 'Cupón removido correctamente',
          'removido' => true
        ]);
      }

      return redirect()->route('carrito.mostrar')->with('success', 'Cupón removido');
    } else {
      if ($request->ajax()) {
        return response()->json([
          'success' => true,
          'mensaje' => 'No había ningún cupón aplicado',
          'removido' => false
        ]);
      }

      return redirect()->route('carrito.mostrar');
    }
  }


  public function detallesCarrito()
  {
    $carrito = session()->get('carrito', []);
    $total = array_reduce($carrito, function ($carry, $item) {
      return $carry + ($item['precio'] * $item['cantidad']);
    }, 0);

    $totalProductos = array_reduce($carrito, function ($carry, $item) {
      return $carry + $item['cantidad'];
    }, 0);

    return response()->json(['carrito' => $carrito, 'total' => $total, 'totalProductos' => $totalProductos]);
  }


  public function mostrarPedido()
  {
    $carrito = session()->get('carrito', []);
    $cuponAplicado = session()->get('cupon_aplicado', null);
    $total = array_reduce($carrito, function ($carry, $item) {
      return $carry + ($item['precio'] * $item['cantidad']);
    }, 0);

    // Si el carrito está vacío, eliminar el cupón (si está aplicado)
    if ($total == 0) {
      session()->forget('cupon_aplicado');
      $cuponAplicado = null;
    }

    // Total con descuento (si hay cupón aplicado)
    $totalFinal = $total;
    if ($cuponAplicado) {
      $totalFinal -= $cuponAplicado['descuento'];
    }

    // Obtener los IDs de los productos en el carrito
    $productoIds = array_keys($carrito);
    $productos = Producto::whereIn('id', $productoIds)->get();

    return view('cliente.pedido', [
      'carrito' => $carrito,
      'productos' => $productos,
      'total' => $total,
      'totalFinal' => $totalFinal,
      'cuponAplicado' => $cuponAplicado,
    ]);
  }

}
