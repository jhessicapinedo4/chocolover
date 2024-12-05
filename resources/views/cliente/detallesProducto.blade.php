@extends('layouts.header')

@section('content')
    <section class="info">
        <div class="container-title">
            <a href="{{ route('productos.index') }}" class="back-button"><i class="bi bi-arrow-left-circle"></i></a>
            {{ $producto->nombre }}
        </div>
        <main id="producto-detalle">
            <div class="container-img">
                <img src="{{ asset('imagenes/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" />
            </div>
            <div class="container-info-product">
                <div class="container-price">
                    <span>S/.{{ number_format($producto->precio, 2) }}</span>
                </div>



                @if ($producto->personalizable)
                    <div class="container-details-product">

                        {{-- falta la logica para el toping aca:  --}}
                        @if ($producto->toppings->count() > 0)
                            <div class="form-group">
                                <label for="topping">Elige un topping</label>
                                <select name="topping" id="topping">
                                    <option disabled selected value="">Escoge una opción</option>
                                    @foreach ($producto->toppings as $topping)
                                        <option value="{{ $topping->id }}">{{ $topping->nombre }} </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <p class="text-muted">Este producto no tiene toppings disponibles.</p>
                        @endif



                        <div class="form-group">
                            <label for="personalizado">Personalización (Opcional)</label>
                            <textarea name="personalizado" placeholder="Escribe aquí tu personalización" style="background-color: #f7f7f7;"></textarea>
                        </div>


                    </div>
                @endif

                <div class="container-add-cart">
                    <button class="btn-add-to-cart" data-product-id="{{ $producto->id }}"
                        data-product-name="{{ $producto->nombre }}" data-product-price="{{ $producto->precio }}"
                        data-product-image="{{ $producto->imagen }}">
                        Agregar al carrito
                    </button>
                </div>

                <div class="container-description">
                    <div class="title-description">
                        <h4>Descripción</h4>
                    </div>
                    <div class="text-description">
                        <p>{{ $producto->descripcion }}</p>
                    </div>
                </div>

                <div class="container-social">
                    <span>Categoría: </span>
                    <div>
                        <a href="#">{{ $producto->categoria->nombre }}</a>
                    </div>
                </div>

                <div class="container-social">
                    <span>Compartir</span>
                    <div class="container-buttons-social">
                        <a href="#"><i class="bi bi-envelope"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection
