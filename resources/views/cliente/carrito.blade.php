@extends('layouts.header')
@section('content')
    <section class="bg-white py-8 antialiased  md:py-4">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <!-- Título principal con texto más grande -->
            <div class="header-title bg-neutral-100 md:py-4">
                <h1>Carrito de compras</h1>
            </div>

            <!-- Mensajes de Éxito o Error -->
            <x-alert type="success" />
            <x-alert type="error" />


            <div class="mt-6 pl-16 sm:mt-16 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="ml-0 w-full lg:max-w-5xl space-y-6">
                    @if (session('carrito'))
                        @foreach (session('carrito') as $id => $detalles)
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
                                <!-- Encabezados -->
                                <div class="grid grid-cols-4 text-center border-b pb-2 mb-4">
                                    <div class="text-lg font-bold text-gray-700">Descripción</div>
                                    <div class="text-lg font-bold text-gray-700">Precio</div>
                                    <div class="text-lg font-bold text-gray-700">Cantidad</div>
                                    <div class="text-lg font-bold text-gray-700">Total</div>
                                </div>
                                <!-- Fila del carrito -->
                                <div class="grid grid-cols-4 items-center text-center gap-4">
                                    <!-- Columna de descripción -->
                                    <div class="flex items-center gap-4">
                                        <img class="h-20 w-20 rounded-md"
                                            src="{{ asset('imagenes/productos/' . $detalles['imagen']) }}"
                                            alt="{{ $detalles['nombre'] }}">
                                        <div class="text-left">
                                            <p class="text-xl font-medium text-gray-900">{{ $detalles['nombre'] }}</p>
                                            {{-- <p class="text-sm font-semibold text-gray-800">Mesaje personalizado</p>
                                            <p class="text-sm font-semibold text-gray-800">topping</p> --}}
                                        </div>
                                    </div>
                                    <!-- Columna de precio -->
                                    <div class="text-xl font-medium text-gray-900">
                                        S/. {{ $detalles['precio'] }}
                                    </div>
                                    <!-- Columna de cantidad -->
                                    <div class="flex items-center justify-center gap-1">
                                        <form action="{{ route('carrito.actualizar') }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="flex items-center justify-center gap-0">
                                                <!-- Botón de Decrementar -->
                                                <button type="button"
                                                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-gray-400 bg-gray-100 hover:bg-gray-200"
                                                    id="decrement-{{ $id }}">
                                                    -
                                                </button>
                                                <!-- Input de Cantidad -->
                                                <input type="number" name="cantidad" value="{{ $detalles['cantidad'] }}"
                                                    min="1"
                                                    class="w-20  border-0 bg-transparent text-center text-xl font-medium text-gray-900 focus:outline-none focus:ring-0 cantidad-input"
                                                    id="cantidad-{{ $id }}">
                                                <!-- Botón de Incrementar -->
                                                <button type="button"
                                                    class=" -ml-4 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-gray-400 bg-gray-100 hover:bg-gray-200"
                                                    id="increment-{{ $id }}">
                                                    +
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Columna de total + botón eliminar -->
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-gray-900">
                                            S/. {{ $detalles['precio'] * $detalles['cantidad'] }}
                                        </p>
                                        <form action="{{ route('carrito.quitar') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit"
                                                class="inline-flex items-center text-lg font-medium text-red-600 hover:underline mt-2">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Quitar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tu carrito está vacío</p>
                    @endif
                </div>

                <div class="ml-0 mt-6 max-w-3xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                        @if (!session()->has('cupon_aplicado'))
                            <form id="coupon-form" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="codigo_cupon" class="mb-2 block text-lg font-medium text-gray-900">
                                        ¿Tienes un código promocional?
                                    </label>
                                    <input type="text" id="codigo_cupon" name="codigo_cupon"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-100 p-2.5 text-lg text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="Escribe tu código aquí" required />
                                </div>
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-6 py-3 text-lg font-medium text-gray-100 bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                    Aplicar descuento
                                </button>
                                
                            </form>
                        @else
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium">Cupón aplicado:
                                        {{ session('cupon_aplicado')['codigo'] }}</span>
                                    <form action="{{ route('cupon.remover') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Remover cupón
                                        </button>
                                    </form>
                                    
                                </div>
                                <label for="codigo_cupon" class="mb-2 block text-lg font-medium text-gray-900">
                                        Si haces alguna modificación en el carrito se removera el cupon aplicado
                                  </label>
                            </div>
                        @endif

                    </div>

                    <div class="space-y-4 rounded-lg border mb-4 border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                        <p class="text-3xl font-bold text-gray-900">Totales del carrito</p>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-lg font-normal text-gray-600">Precio total</dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        S/. {{ number_format($total, 2) }}
                                    </dd>
                                </dl>

                                @if (session()->has('cupon_aplicado'))
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-lg font-normal text-gray-600">Descuento</dt>
                                        <dd class="text-lg font-medium text-green-600">
                                            -S/. {{ number_format(session('cupon_aplicado')['descuento'], 2) }}
                                        </dd>
                                    </dl>
                                @endif

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-lg font-normal text-gray-600">Total final</dt>
                                    <dd class="text-lg font-bold text-gray-900">
                                        S/. {{ number_format($totalFinal, 2) }}
                                    </dd>
                                </dl>
                            </div>
                        </div>


                        <a href="{{ Auth::check() && Auth::user()->role == 'cliente' ? route('pedido') : route('cliente.login') }} "
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-6 py-3 text-lg font-medium text-gray-100 bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-primary-300">Finalizar
                            compra</a>

                        <div class="flex items-center justify-center gap-2">
                            <span class="text-lg font-normal text-gray-500"> o </span>
                            <a href="" title=""
                                class="inline-flex items-center gap-2 text-lg font-medium text-primary-700 underline hover:no-underline">
                                Continuar comprando
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    <!-- Pasar la variable 'cupon_aplicado' a JS -->
    <script>
        window.cuponAplicado = @json(session('cupon_aplicado'));
    </script>


    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Función para manejar la eliminación y aplicación del cupón
                function manejarCupon(action) {
                    let url = action === 'remover' ? '{{ route('cupon.remover') }}' : '{{ route('aplicar.cupon') }}';
                    let method = 'POST';
                    let formData = new FormData();

                    if (action === 'aplicar') {
                        // Si estamos aplicando el cupón, tomamos el valor del formulario
                        formData = new FormData(document.getElementById('coupon-form'));
                    }

                    fetch(url, {
                            method: method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (action === 'aplicar') {
                                    window.location.reload(); // Recargar la página para reflejar el cupón aplicado
                                } else if (action === 'remover' && data.removido) {
                                    window.location.reload(); // Recargar la página para reflejar el cupón removido
                                }
                                // No hacer nada si remover pero no se removió ningún cupón
                            } else {
                                alert(data.mensaje); // Mostrar mensaje de error si no se pudo aplicar
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Su cupón sera removido');
                        });
                }

                // Agregar comportamiento a los botones de disminuir
                document.querySelectorAll('[id^="decrement-"]').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.id.split('-')[1]; // Obtiene el ID del producto
                        let input = document.getElementById('cantidad-' + id);
                        let cantidad = parseInt(input.value);

                        if (cantidad > 1) {
                            input.value = cantidad - 1;
                        } else {
                            if (confirm("¿Seguro que deseas eliminar este producto del carrito?")) {
                                input.value = 0;
                                // Enviar el formulario para actualizar el carrito
                                input.closest('form').submit();
                            } else {
                                return; // No hacer nada si no confirma
                            }
                        }

                        // Eliminar cupón solo si había uno aplicado
                        if (window.cuponAplicado) {
                            manejarCupon('remover');
                        }

                        // Enviar el formulario para actualizar la cantidad
                        // Solo si la cantidad es mayor a 0
                        if (input.value > 0) {
                            input.closest('form').submit();
                        }
                    });
                });

                // Agregar comportamiento a los botones de incrementar
                document.querySelectorAll('[id^="increment-"]').forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.id.split('-')[1]; // Obtiene el ID del producto
                        let input = document.getElementById('cantidad-' + id);
                        let cantidad = parseInt(input.value);
                        input.value = cantidad + 1;

                        // Eliminar cupón solo si había uno aplicado
                        if (window.cuponAplicado) {
                            manejarCupon('remover');
                        }

                        // Enviar el formulario para actualizar la cantidad
                        input.closest('form').submit();
                    });
                });

                // Actualizar el formulario al cambiar el valor manualmente
                document.querySelectorAll('.cantidad-input').forEach(function(input) {
                    input.addEventListener('change', function() {
                        let cantidad = parseInt(input.value);
                        if (cantidad <= 0) {
                            if (confirm("¿Seguro que deseas eliminar este producto del carrito?")) {
                                input.value = 0;
                                input.closest('form').submit(); // Enviar el formulario para eliminar el producto
                            } else {
                                input.value = 1; // Volver a poner la cantidad a 1 si no se confirma
                            }
                        } else {
                            // Eliminar cupón solo si había uno aplicado
                            if (window.cuponAplicado) {
                                manejarCupon('remover');
                            }
                            input.closest('form').submit(); // Enviar el formulario para actualizar la cantidad
                        }
                    });
                });

                // Manejar la aplicación del cupón al enviarse el formulario
                const couponForm = document.getElementById('coupon-form');
                if (couponForm) {
                    couponForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        manejarCupon('aplicar');
                    });
                }
            });
        </script>
    @endpush


@endsection

