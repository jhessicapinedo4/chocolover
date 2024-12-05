@extends('layouts.header')

@section('content')
    <svg class="d-none">
        <symbol id="icon_star" viewBox="0 0 9 9">
            <path
                d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z" />
        </symbol>
    </svg>

    <section class="container top-products">

        <div class="header-title">
            <h1>Productos</h1>
        </div>


        <div class="botones-platillos">
            <button class="todos btn btn-verde" data-category="todos">
                <span>Todos</span>
            </button>
            <button class="torta btn btn-verde" data-category="Tortas">
                <span>Tortas</span>
            </button>
            <button class="detalle btn btn-verde" data-category="Detalles">
                <span>Detalles</span>
            </button>
            <button class="pack btn btn-verde" data-category="Packs">
                <span>Cuchareables</span>
            </button>
            <button class="bocadito btn btn-verde" data-category="Bocaditos">
                <span>Bocaditos</span>
            </button>
        </div>


        


        <div class="relative flex items-center w-full mx-auto mb-2">
            <!-- Barra de búsqueda más larga -->
            <input type="text" id="searchInput"
                class="w-full max-w-full px-8 py-4 text-xl rounded-full border-2 border-gray-300 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-200 transition-all duration-300 ease-in-out  placeholder-gray-500"
                placeholder="Buscar productos..." aria-label="Buscar productos" aria-describedby="button-addon2" />

            <!-- Icono de búsqueda -->
            <button type="button" id="button-addon2"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-700 text-gray-100 p-4 rounded-3xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-300 ease-in-out">
                <i class="bi bi-search"></i>
            </button>
        </div>



        <x-lista-productos :productos="$productos" />
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.botones-platillos button');
            const products = document.querySelectorAll('.platillo');
            // const searchInput = document.getElementById('searchInput');

            // Filtrar productos por categoría ------ LO QUE ME PEDISTE
            const filterByCategory = (category) => {
                products.forEach(product => {
                    const productCategory = product.getAttribute('data-platillo');
                    if (category === 'todos' || productCategory === category) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            };



            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const category = button.getAttribute('data-category');
                    filterByCategory(category);
                });
            });

        });
    </script>
@endsection
