@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('desing/css/style.css') }}">
@endpush

<section class="container top-products">
    <h1 class="text-5xl font-bold text-center text-gray-800 m-4">
    Productos populares
</h1>


    <div class="container-products">
        <div class="platillos">
            @foreach ($productosPopulares as $producto)
                <div class="platillo" data-platillo="{{ $producto->Categoria->nombre ?? 'sin-categoria' }}">
                    <a href="{{ route('productos.showCliente', $producto->slug) }}">
                        <div class="container-img">
                            <img src="{{ asset('imagenes/productos/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre }}" />
                        </div>
                        <div class="content-card-product">
                            <div class="stars mt-6">
                                <x-estrellas-calificacion :producto="$producto" />
                            </div>
                            <h3>{{ $producto->nombre }}</h3>
                            <span class="add-cart">Ver más</span>
                            <p class="price">S/. {{ $producto->precio }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


</section>
