@extends('layouts.header') @section('content')
    <section class="bg-white py-8 md:py-4">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0"> <!-- Título principal -->
            <div class="header-title bg-neutral-100 md:py-4">
                <h1 class="text-4xl font-extrabold text-gray-900">Detalles del Pedido</h1>
            </div>
            <div class="mt-6 pl-16 sm:mt-16 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <!-- Columna izquierda: Información de pago -->
                <div class="w-full lg:max-w-5xl space-y-6">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="text-2xl font-bold text-gray-900 mb-4">¡Su orden fue recibida!</div>
                        <!-- Contenedor de dos columnas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <!-- Columna izquierda: Detalles de pago -->
                            <div class="space-y-4">
                                <div class="bg-pink-100 p-4 rounded-lg">
                                    <p class="text-gray-800">Pedido #OR-47A5233A</p> <!-- Método de pago -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Método de pago:</p>
                                        <p class="text-gray-800">Transferencia bancaria - Banco BCP</p>
                                    </div> <!-- Datos del cliente -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Nombre:</p>
                                        <p class="text-gray-800">Oscar Cardoso</p>
                                    </div> <!-- Número de cuenta -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Número de cuenta:</p>
                                        <p class="text-gray-800">570058982420073</p>
                                    </div> <!-- Cuenta interbancaria -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Número de cuenta interbancaria:</p>
                                        <p class="text-gray-800">002570105898242070306</p>
                                    </div> <!-- Documento -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Documento:</p>
                                        <p class="text-gray-800">DNI</p>
                                    </div> <!-- Número de documento -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Número Documento:</p>
                                        <p class="text-gray-800">73801615</p>
                                    </div> <!-- Instrucciones -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">Instrucciones:</p>
                                        <p class="text-gray-800">Subir comprobante de pago</p>
                                    </div>
                                </div>
                            </div> <!-- Columna derecha: Cuadro para subir foto -->
                            <div class="space-y-4">
                                <div
                                    class="bg-gray-100 p-6 rounded-lg border-2 border-dashed border-gray-300 flex justify-center items-center cursor-pointer hover:border-blue-500 transition-all">
                                    <label for="comprobante" class="flex flex-col items-center text-gray-600">
                                        <!-- Ícono de subida --> <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-12 w-12 mb-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v10.293l3.354-3.353a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L9 14.293V4a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg> <span class="text-xl font-semibold text-gray-700">Subir Comprobante</span>
                                        <input type="file" id="comprobante" class="hidden" /> </label> </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Columna derecha: Resumen del pedido -->
                <div class="ml-0 mt-6 max-w-3xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="text-2xl font-bold text-center text-gray-900 mb-6">Su Pedido</div> <!-- Producto -->
                        <div class="bg-white rounded-lg shadow-md p-6 flex items-center mb-4"> <img
                                src="https://via.placeholder.com/100" alt="Mini cheesecake"
                                class="w-20 h-20 rounded-lg object-cover mr-6">
                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-gray-900">Mini cheesecake de frutos rojos</h3>
                                <p class="text-gray-500">Cantidad: 1</p>
                                <p class="text-gray-500">Mensaje personalizado: Feliz</p>
                                <p class="text-gray-500">Topping: Chispas de chocolate</p>
                            </div> <span class="text-xl font-bold text-red-500">S/ 50.00</span>
                        </div> <!-- Totales -->
                        <div class="border-t border-b py-4 mt-4">
                            <div class="flex justify-between mb-2"> <span class="text-xl">Total Parcial</span> <span
                                    class="font-bold text-xl">S/ 50.00</span> </div>
                            <div class="flex justify-between mb-2"> <span class="text-xl">Envío</span> <span
                                    class="font-bold text-xl">Recoge en Local</span> </div>
                        </div> <!-- Total final -->
                        <div class="flex justify-between text-2xl font-extrabold text-red-600 mt-4"> <span
                                class="text-xl">TOTAL</span> <span class="font-bold text-xl">S/ 50.00</span> </div>
                        <!-- Botón para finalizar pedido --> <button
                            class="w-full py-4 rounded-lg text-white bg-green-600 text-lg font-bold hover:bg-green-700 transition-all duration-300 mt-6">
                            Ir a pagar pedido </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection
