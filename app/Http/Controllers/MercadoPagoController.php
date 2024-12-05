<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Pedidos;
use App\Models\ArticulosPedido;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
  /**
   * Crea una preferencia de pago en Mercado Pago.
   */
  public function createPaymentPreference(Request $request)
  {
    $accessToken = config('services.mercadopago.token');

    // Log de datos recibidos
    Log::info('Datos recibidos para preferencia:', [
      'productos' => $request->input('productos'),
      'formulario' => $request->all()
    ]);

    // Preparar ítems de la preferencia
    $items = [];
    $total = 0;

    foreach ($request->input('productos') as $producto) {
      $itemTotal = $producto['quantity'] * $producto['unit_price'];
      $total += $itemTotal;

      $items[] = [
        'id' => $producto['id'],
        'title' => $producto['title'],
        'quantity' => $producto['quantity'],
        'unit_price' => $producto['unit_price'],
        'currency_id' => 'PEN'
      ];
    }

    // Datos de la preferencia más simples
    $preferenceData = [
      'items' => $items,
      'back_urls' => [
        'success' => route('mercadopago.success'),
        'failure' => route('mercadopago.failure'),
        'pending' => route('mercadopago.pending')
      ],
      'auto_return' => 'approved'
    ];

    // Log de datos a enviar
    Log::info('Datos de preferencia a enviar:', $preferenceData);

    // Llamada a la API de Mercado Pago
    try {
      $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json'
      ])->post('https://api.mercadopago.com/checkout/preferences', $preferenceData);

      // Log de respuesta completa
      Log::info('Respuesta Mercado Pago:', [
        'status' => $response->status(),
        'body' => $response->body()
      ]);

      if ($response->successful()) {
        $preference = $response->json();
        return response()->json(['id' => $preference['id']]);
      }

      // Si no es exitoso, log de error
      Log::error('Error en creación de preferencia', [
        'status' => $response->status(),
        'body' => $response->body()
      ]);

      return response()->json([
        'error' => 'No se pudo crear la preferencia',
        'details' => $response->body()
      ], 500);
    } catch (\Exception $e) {
      Log::error('Excepción al crear preferencia', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
      ]);

      return response()->json([
        'error' => 'Error al procesar el pago',
        'details' => $e->getMessage()
      ], 500);
    }
  }

  /**
   * Maneja la respuesta de éxito después de realizar el pago.
   */
  public function success(Request $request)
  {
    Log::info('Mercado Pago success callback:', $request->all());

    // Obtener el ID del pedido desde 'external_reference'
    $external_reference = $request->input('external_reference');

    if ($external_reference) {
      $pedido = Pedidos::find($external_reference);
      if ($pedido) {
        $pedido->estado = 'aprobado';
        $pedido->save();
      }
    }

    return view('cliente.pedido_confirmado')->with('mensaje', 'Pago exitoso y pedido realizado.');
  }

  /**
   * Maneja la respuesta de fallo después de intentar el pago.
   */
  public function failure(Request $request)
  {
    Log::info('Mercado Pago failure callback:', $request->all());

    // Obtener el ID del pedido desde 'external_reference'
    $external_reference = $request->input('external_reference');

    if ($external_reference) {
      $pedido = Pedidos::find($external_reference);
      if ($pedido) {
        $pedido->estado = 'fallido';
        $pedido->save();
      }
    }

    return redirect()->route('pedido')->with('error', 'Pago fallido. Por favor, intenta nuevamente.');
  }

  /**
   * Maneja la respuesta de pendiente después de intentar el pago.
   */
  public function pending(Request $request)
  {
    Log::info('Mercado Pago pending callback:', $request->all());

    // Obtener el ID del pedido desde 'external_reference'
    $external_reference = $request->input('external_reference');

    if ($external_reference) {
      $pedido = Pedidos::find($external_reference);
      if ($pedido) {
        $pedido->estado = 'pendiente';
        $pedido->save();
      }
    }

    return redirect()->route('pedido')->with('info', 'Pago pendiente. Te contactaremos pronto.');
  }

  /**
   * (Opcional) Maneja los webhooks de Mercado Pago.
   */
  public function webhook(Request $request)
  {
    // Aquí puedes procesar las notificaciones de Mercado Pago si lo deseas
    // Por simplicidad, no lo implementaremos ahora
    return response()->json(['status' => 'ok']);
  }
}
