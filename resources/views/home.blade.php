

@extends('layouts.header')

@section('content')
    <svg class="d-none">
        <symbol id="icon_star" viewBox="0 0 9 9">
            <path
                d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z" />
        </symbol>
    </svg>
    <div class="carrusel">
        <div class="list">
            @foreach ($carruseles as $carrusel)
                @if ($carrusel->imagen)
                    <!-- Aseguramos que haya una imagen -->
                    <div class="item">
                        <img src="{{ asset('imagenes/carrusel/' . $carrusel->imagen) }}" alt="Imagen Carrusel" />
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Botones de navegación del carrusel -->
        <div class="buttons">
            <button id="prev">
                <span><i class="bi bi-caret-left-fill"></i></span>
            </button>
            <button id="next">
                <span><i class="bi bi-caret-right-fill"></i></span>
            </button>
        </div>

        <!-- Puntos para navegación -->
        <ul class="dots">
            @foreach ($carruseles as $index => $carrusel)
                <li class="{{ $index === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ul>
    </div>


    <!-- Categorías -->
    <div class="hm-page-block">
        <div class="container-1">
            <div class="header-title">
                <h1>¿Qué estas buscando hoy?</h1>
            </div>

            <div class="categories-carousel">
                <div class="swiper multiple-slide-carousel">
                    <!-- Contenedor de diapositivas -->
                    <div class="swiper-wrapper">
                        @foreach ($categorias as $categoria)
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <img src="{{ asset('imagenes/categorias/' . $categoria->imagen) }}"
                                        alt="{{ $categoria->nombre }}" class="category-image" />
                                    <h3 class="category-title">{{ $categoria->nombre }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Botones de navegación -->
                    <button class="swiper-button prev-btn" id="prevBtn">
                        &#x276E;
                    </button>
                    <button class="swiper-button next-btn" id="nextBtn">
                        &#x276F;
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Oferta -->
    <section id="offers" style="background: url({{ asset('imagenes/promocionnnn.jpeg') }}) center/cover no-repeat;
    margin-bottom: 10px;
    margin: 25px;" >
        <div class="container">
            <div
                class="row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
                <div class="offers-content">
                    <span class="text-white">Hasta 40% de descuento</span>
                    <h2 class="mt-2 mb-4 text-white">¡Grandes ofertas de venta!</h2>
                    <a href="productos.html" class="boo">Compra ahora!!</a>
                </div>
            </div>
        </div>
    </section>

  
   <x-populares :productosPopulares="$productosPopulares" />
   
@endsection
