<?php

use App\Http\Controllers\CartaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ClienteAuthController;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\cliente\ProductController;
use App\Http\Controllers\ProductoToppingController;
use App\Http\Controllers\ToppingController;

use App\Http\Controllers\UserController;


use App\Http\Controllers\CalificacionController;

use App\Http\Controllers\admin\AdminCalificacionController;
use App\Http\Controllers\CarritoController;
// Rutas públicas

use App\Http\Controllers\CartController;
use App\Http\Controllers\admin\CuponController;
use App\Http\Controllers\CarruselController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RecetaController;
use App\Models\Receta;





// Rutas de Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
  
  Route::get('/admin', function () {
    return view('Admin.index');
  })->name('dashboard');

  Route::resource('carrusel', CarruselController::class);
  //tabla de users:

  
  Route::resource('users', UserController::class);

  // Rutas de categorías
  Route::resource('categorias', CategoriaController::class);

  Route::put('categorias/{categoria}/activate', [CategoriaController::class, 'activate'])->name('categorias.activate');
  Route::put('categorias/{categoria}/deactivate', [CategoriaController::class, 'deactivate'])->name('categorias.deactivate');
  
  // Route::get('/categorias/{slug}', [CategoriaController::class, 'show'])->name('categorias.show');
  

  Route::resource('productos', ProductoController::class);
  Route::put('productos/{producto}/activate', [ProductoController::class, 'activate'])->name('productos.activate');
  Route::put('productos/{producto}/deactivate', [ProductoController::class, 'deactivate'])->name('productos.deactivate');

  // Rutas de toppings
  Route::resource('toppings', ToppingController::class);


  // Route::get('/productos/toppings', [ProductoController::class, 'toppings'])->name('productos.toppings');
  Route::get('/productos/toppings/assign', [ProductoController::class, 'assignToppingForm'])->name('productos.asignar_toppings');


  Route::post('/productos/toppings/assign', [ProductoController::class, 'assignTopping'])->name('productos.toppings_producto');
  
  // Route::post('/productos/toppings/assign', [ProductoController::class, 'assignTopping'])->name('productos.toppings.assign');
  
  Route::get('/relacion_topping', [ProductoToppingController::class, 'index'])->name('producto_toppings.index');


  Route::get('/admin/calificaciones', [AdminCalificacionController::class, 'index'])->name('admin.calificaciones.index');
  Route::delete('/admin/calificaciones/{id}', [AdminCalificacionController::class, 'destroy'])->name('admin.calificaciones.destroy');



  Route::resource('recetas', RecetaController::class)->names('recetas');

  Route::resource('cupones', CuponController::class);


  // Activar o desactivar cupones
  Route::put('/admin/cupones/{id}/activate', [CuponController::class, 'activate'])->name('Admin.cupones.activate');
  Route::put('/admin/cupones/{id}/deactivate', [CuponController::class, 'deactivate'])->name('Admin.cupones.deactivate');



});



Route::middleware(['auth', 'role:cliente'])->group(function () {
  Route::get('/cliente/dashboard', function () {
    return view('cliente.dashboard');
  })->name('cliente.dashboard');

  // Mostrar calificaciones de un producto
  Route::get('/producto/{producto}/calificaciones', [CalificacionController::class, 'showProductRatings'])->name('cliente.producto.calificaciones');

  // Dejar una nueva calificación para un producto
  Route::post('/producto/{producto}/calificar', [CalificacionController::class, 'store'])->name('cliente.producto.calificar');
  Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificacion.store');


  // Usar un cupón (por un cliente registrado)
  Route::post('/admin/cupones/use', [CuponController::class, 'useCupon'])->name('Admin.cupones.use');


  Route::post('/aplicar-cupon', [CarritoController::class, 'aplicarCupon'])->name('aplicar.cupon');
  Route::post('/remover-cupon', [CarritoController::class, 'removerCupon'])->name('cupon.remover');
  Route::get('/ordenes', function () {
    return view('Admin.ordenes');
  });
  
});




// Rutas de perfil
// Rutas de perfil para Admin
Route::middleware('auth', 'role:admin')->group(function () {
  
  Route::get('/profile/admin', [ProfileController::class, 'editAdmin'])->name('profile_admin.edit');
  Route::patch('/profile/admin', [ProfileController::class, 'updateAdmin'])->name('profile_admin.update');
  Route::delete('/profile/admin', [ProfileController::class, 'destroyAdmin'])->name('profile_admin.destroy');
});

// Rutas de perfil para Cliente
Route::middleware('auth', 'role:cliente')->group(function () {
  Route::get('/cliente/profile', [ProfileController::class, 'editCliente'])
    ->name('profile_cliente.edit');

  Route::patch('/cliente/profile', [ProfileController::class, 'updateCliente'])
    ->name('profile_cliente.update');

  Route::delete('/cliente/profile', [ProfileController::class, 'destroyCliente'])
    ->name('profile_cliente.destroy');


  // Ruta para mostrar el pedido
  Route::get('/pedido', [CarritoController::class, 'mostrarPedido'])->name('pedido');

  // Ruta para crear la preferencia de pago
  Route::post('/create-preference', [MercadoPagoController::class, 'createPaymentPreference'])->name('create.preference')->middleware('auth');


  Route::post('/create-preference', [MercadoPagoController::class, 'createPaymentPreference'])
  ->name('create.preference');
  // Rutas de retorno de Mercado Pago
  Route::get('/mercadopago/success', [MercadoPagoController::class, 'success'])->name('mercadopago.success');
  Route::get('/mercadopago/failure', [MercadoPagoController::class, 'failure'])->name('mercadopago.failure');
  Route::get('/mercadopago/pending', [MercadoPagoController::class, 'pending'])->name('mercadopago.pending');

  // (Opcional) Ruta para manejar los webhooks de Mercado Pago
  Route::post('/webhook/mercadopago', [MercadoPagoController::class, 'webhook'])->name('mercadopago.webhook');

 

});


Route::get('/contacto', function () {
  return view('cliente.contacto');
});





require __DIR__ . '/auth.php';


// Rutas de Cliente (sin autenticación)
Route::get('/cliente/register', [ClienteAuthController::class, 'showRegistrationForm'])
  ->name('cliente.register');
Route::post('/cliente/register', [ClienteAuthController::class, 'register']);
Route::get('/cliente/login', [ClienteAuthController::class, 'showLoginForm'])
  ->name('cliente.login');
Route::post('/cliente/login', [ClienteAuthController::class, 'login']);





Route::get('/terminos', function () {
  return view('cliente.terminos');
});


Route::get('/politicas', function () {
  return view('cliente.politicas');
});


Route::get('/nosotros', function () {
  return view('cliente.nosotros');
});


//publicas

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/productos-populares', [ProductoController::class, 'productosPopulares'])->name('productos.populares');

Route::get('/catalogo', [CartaController::class, 'index'])->name('cliente.productos');
//para cliente:
Route::get('/carta/{slug}', [ProductoController::class, 'showCliente'])->name('productos.showCliente');


Route::post('/carrito/agregar', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/quitar', [CarritoController::class, 'quitarProducto'])->name('carrito.quitar');
Route::get('/carrito/detalles', [CarritoController::class, 'detallesCarrito']);

Route::get('/recetass', [RecetaController::class, 'indexCliente'])->name('recetas.indexCliente');

Route::get('/recetass/{id}', [RecetaController::class, 'showCliente'])->name('recetas.cliente.show');


