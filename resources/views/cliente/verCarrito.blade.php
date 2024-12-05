
{{-- CARRITO FLOTANTE OK??? --}}
@extends('layouts.header')

@section('content')

   <div class="relative z-[100] hidden" id="cart-slide-over" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/10 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full">
                <div class="pointer-events-auto w-[430px]">
                    <div class="flex flex-col bg-white shadow-xl h-full">
                        <!-- Título -->
                        <div class="flex-1 pl-6 pr-6 py-6 sm:pl-8 sm:pr-4">
                            <div class="flex items-center justify-center">
                                <h2 class="text-5xl font-semibold text-gray-900" id="slide-over-title">Mi carrito</h2>
                                <button type="button" id="close-cart" class="absolute top-8 left-[-26px] flex items-center text-gray-600 hover:text-gray-900">
                                    <div class="flex items-center justify-center bg-gray-100 text-gray-900 rounded-full w-16 h-16 hover:bg-red-600 hover:text-white">
                                        <svg class="h-10 w-10 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <!-- Productos -->
                            <div class="mt-8 cart-products-container overflow-y-auto">
                                <div class="flow-root">
                                    <ul id="cart-products">
                                        <!-- Producto 1 -->
                                        <li class="flex py-4 gap-3">
                                            <div class="overflow-hidden rounded-md border border-gray-200">
                                                <img src="ruta/a/la/imagen1.jpg" alt="Producto 1" style="height: 75px; width: 75px; object-fit: cover;" class="h-full w-full object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between font-medium text-gray-900">
                                                    <h3>Producto 1</h3>
                                                    <p class="text-xl font-bold text-gray-800">S/. 45.00</p>
                                                </div>
                                                <div class="flex items-center justify-between mt-3">
                                                    <div class="quantity-selector flex items-center gap-1">
                                                        <button class="decrease-quantity bg-gray-200 px-3 py-1 rounded-bl-full">-</button>
                                                        <span class="text-gray-900 border border-gray-300 px-3 py-1 rounded-md text-lg">1</span>
                                                        <button class="increase-quantity bg-gray-200 px-3 py-1 rounded-bl-full mr-1">+</button>
                                                        <span class="ml-3 text-xl text-gray-500 font-light">× S/. 45.00</span>
                                                    </div>
                                                    <div class="mt-2 text-center">
                                                        <button class="text-red-600 hover:text-red-800 text-3xl font-medium remove-product">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>   
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Total y botones -->
                        <div class="border-t border-gray-200 px-6 py-6">
                            <div class="flex justify-between text-xl font-semibold text-gray-900">
                                <p>Total parcial:</p>
                                <p id="cart-total">S/. 75.00</p>
                            </div>
                            <div class="mt-6 flex flex-col gap-4">
                                <button class="w-full rounded-3xl bg-gray-300 px-6 py-3 text-2xl font-medium text-white shadow-sm hover:bg-gray-500">
                                    Ver carrito
                                </button>
                                <button class="boton">Finalizar compra</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
