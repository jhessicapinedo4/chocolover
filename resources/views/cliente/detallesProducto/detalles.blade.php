@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('desing/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('desing/css/custom.css') }}">
@endpush

@extends('layouts.header')

@section('content')
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

        <svg class="d-none">
            <symbol id="icon_star" viewBox="0 0 9 9">
                <path
                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z" />
            </symbol>
        </svg>

        <section class="info">
            <div class="container-title">
                <a href="{{ route('productos.index') }}" class="back-button"></i></a>
                {{ $producto->nombre }}
            </div>

            
        </section>

    
      
        <main class="pt-2">

          
          

            <section class="product-single container">

                <div class="row">
                    <div class="col-lg-7">
    <div class="product-single__media">
        <div class="product-single__image">
            <div class="imagen">
                <!-- Hacemos la imagen responsiva usando clases de Tailwind -->
                <img class="w-full h-auto object-cover"
                    src="{{ asset('imagenes/productos/' . $producto->imagen) }}"
                    alt="{{ $producto->nombre }}" />
            </div>
        </div>
    </div>
</div>




                    <div class="col-lg-5">
                        <h1 class="product-single__name">{{ $producto->nombre }}</h1>


                        <div class="product-single__rating">
                            <div class="product-single__rating">
                                <x-estrellas-calificacion :producto="$producto" />
                                <span
                                    class="reviews-note text-lowercase text-secondary ms-1">{{ $producto->calificaciones->count() }}+
                                    personas</span>
                            </div>

                        </div>

                        <div class="product-single__price">
                            <span class="current-price">S/. {{ number_format($producto->precio, 2) }}</span>
                        </div>

                        <div class="container-details-product">
                            {{-- Toppings --}}
                            @if ($producto->toppings->count() > 0)
                                <div class="form-group">
                                    <label for="topping">Elige un topping</label>
                                    <select name="topping" id="topping">
                                        <option disabled selected value="">Escoge una opción</option>
                                        @foreach ($producto->toppings as $topping)
                                            <option value="{{ $topping->id }}">{{ $topping->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <p class="text-muted">Este producto no tiene toppings disponibles.</p>
                            @endif

                            {{-- Personalización (opcional) --}}
                            <div class="form-group">
                                <label for="personalizado">Personalización (Opcional)</label>
                                <textarea name="personalizado" placeholder="Escribe aquí tu personalización" style="background-color: #f7f7f7;"></textarea>
                            </div>

                        </div>

                        <div class="product-single__short-desc">
                            <p>{{ $producto->descripcion }}</p>
                        </div>


                        <div class="product-single__addtocart">
                            <div class="qty-control position-relative">
                                <input type="number" id="qty-control" name="quantity" value="1" min="1"
                                    class="qty-control__number text-center" onchange="updateHiddenQuantity()">

                                <div class="qty-control__reduce" onclick="changeQuantity(-1)">-</div>
                                <div class="qty-control__increase" onclick="changeQuantity(1)">+</div>
                            </div>

                            <form action="{{ route('carrito.agregar') }}" method="POST" onsubmit="updateHiddenQuantity()">
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto->id }}">
                                <input type="hidden" name="quantity" id="quantity-input" value="1">
                                <!-- Inicializa con el valor del input -->

                                <button data-product-id="{{ $producto->id }}" type="submit"
                                    class="btn-add-to-cart w-full sm:w-auto px-6 py-3 mt-2 font-semibold rounded-md transition-colors duration-200">
                                    Agregar al carrito
                                </button>
                            </form>
                        </div>



                        <div class="container-social" style="font-size: 10px">
                            <div class="meta-item">
                                <label>Categoría:</label>
                                <span>{{ $producto->categoria->nombre }}</span>
                            </div>
                        </div>

                        <div class="container-social" style="font-size: 10px">
                            <span>Compartir</span>
                            <x-compartir />
                        </div>
                    </div>
                </div>


                {{-- para info adicional y Calificaciones --}}
                <div class="product-single__details-tab">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                                href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                                aria-selected="false">Informacion adicional</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                                href="#tab-reviews" role="tab" aria-controls="tab-reviews"
                                aria-selected="false">Calificaciones ({{ $producto->calificaciones->count() }})</a>
                        </li>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                            aria-labelledby="tab-additional-info-tab">
                            <div class="product-single__addtional-info">
                                <div class="item">
                                    <label class="h6">Alergenicos</label>
                                    <span>Harina</span>
                                </div>
                                <div class="item">
                                    <label class="h6">Dimensions</label>
                                    <span>90 x 60 x 90 cm</span>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                            <h2 class="product-single__reviews-title">Reseñas</h2>

                            <x-listado-calificaciones :producto="$producto" />

                            <div class="product-single__review-form mb-4">
                                <x-formulario-calificacion :producto="$producto" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>


    </div>

    @push('js')
        <script src="{{ asset('desing/js/plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('desing/js/plugins/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('desing/js/plugins/bootstrap-slider.min.js') }}"></script>
        <script src="{{ asset('desing/js/plugins/swiper.min.js') }}"></script>
        <script src="{{ asset('desing/js/theme.js') }}"></script>


        <script>
            $.ajax({
                url: "{{ route('calificacion.store') }}", // Ruta para almacenar la calificación
                type: 'POST',
                data: formData, // Datos del formulario (comentario, calificación, etc.)
                success: function(response) {
                    // Si la calificación se guarda con éxito
                    if (response.message === 'Calificación guardada con éxito') {
                        // Recargar la página para mostrar el comentario recién agregado
                        window.location.reload(); // Recarga la página
                    } else {
                        alert('Hubo un problema al guardar la calificación. Intenta de nuevo.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error al enviar la calificación. Intenta de nuevo.');
                }
            });
        </script>
        <script>
            // Función para actualizar el campo hidden con el valor del campo de cantidad
            function updateHiddenQuantity() {
                var qtyControl = document.getElementById('qty-control');
                var quantityInput = document.getElementById('quantity-input');

                // Asigna el valor del campo qty-control al campo quantity-input
                quantityInput.value = qtyControl.value;
            }
            function changeQuantity(amount) {
                var qtyControl = document.getElementById('qty-control');
                var newQuantity = parseInt(qtyControl.value) + amount;

                // Asegúrate de que el valor sea mayor o igual a 1
                if (newQuantity >= 1) {
                    qtyControl.value = newQuantity;
                    updateHiddenQuantity(); 
                }
            }
        </script>
    @endpush
@endsection
