@push('css')
    <!-- SweetAlert2 -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- MercadoPago Script -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
@endpush

@extends('layouts.header')

@section('content')
    <section class="bg-white py-8 md:py-4">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="header-title bg-neutral-100 md:py-4 rounded-lg">
                <h1 class="text-4xl font-extrabold text-gray-900">Detalles del Pedido</h1>
            </div>
            <div class="mt-6 pl-16 sm:mt-16 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="w-full lg:max-w-5xl space-y-6">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

                        <!-- Información del Envío -->
                        <div class="text-2xl font-bold text-gray-900 mb-4">¿Cómo deseas recibir tu pedido?</div>
                        <div class="flex justify-between gap-5 mb-6">
                            <label for="recoger"
                                class="w-1/2 text-center cursor-pointer rounded-lg border border-gray-300 transition-all duration-300 hover:shadow-lg">
                                <input type="radio" name="opcion_envio" id="recoger" class="hidden peer"
                                    onchange="toggleEnvío()" checked>
                                <span
                                    class="block text-xl font-semibold text-gray-700 peer-checked:text-white peer-checked:bg-red-500 py-3 px-4 rounded-lg">
                                    Recoger en Local
                                </span>
                            </label>
                            <label for="enviar"
                                class="w-1/2 text-center cursor-pointer rounded-lg border border-gray-300 transition-all duration-300 hover:shadow-lg">
                                <input type="radio" name="opcion_envio" id="enviar" class="hidden peer"
                                    onchange="toggleEnvío()">
                                <span
                                    class="block text-xl font-semibold text-gray-700 peer-checked:text-white peer-checked:bg-red-500 py-3 px-4 rounded-lg">
                                    Envío a Domicilio
                                </span>
                            </label>
                        </div>
                        <div id="tarifaEnvioFields" class="hidden space-y-6">
                            <div class="text-2xl font-bold text-gray-900 mb-4">La tarifa estándar de envío:</div>
                            <!-- Opción de Tarifa de Envío -->
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <label class="flex items-center gap-4">
                                    <div>
                                        <p class="text-lg font-semibold text-gray-800">ENVÍO</p>
                                        <p class="text-xl font-bold text-gray-900">S/ 6.00</p>
                                        <p class="text-md text-gray-600 mt-2">El envío es estándar, para cualquier parte de
                                            la ciudad de Trujillo únicamente.</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Datos del Cliente -->
                        <div class="text-2xl font-bold text-gray-900 mb-4">Datos del Cliente</div>
                        <form id="payment-form">
                            @csrf
                            <div class="space-y-4 rounded-lg border border-white bg-white ">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xl font-semibold text-gray-700 mb-2">Fecha de Entrega
                                            *</label>
                                        <input type="date" name="fecha_entrega"
                                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-xl font-semibold text-gray-700 mb-2">Hora de Entrega
                                            *</label>
                                        <select name="hora_entrega"
                                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300"
                                            required>
                                            <option value="" disabled selected>Selecciona un rango de hora</option>
                                            <!-- Rango de horas -->
                                            <option value="09:00-10:00">09:00 - 10:00</option>
                                            <option value="10:00-11:00">10:00 - 11:00</option>
                                            <option value="11:00-12:00">11:00 - 12:00</option>
                                            <option value="12:00-13:00">12:00 - 13:00</option>
                                            <option value="13:00-14:00">13:00 - 14:00</option>
                                            <option value="14:00-15:00">14:00 - 15:00</option>
                                            <option value="15:00-16:00">15:00 - 16:00</option>
                                            <option value="16:00-17:00">16:00 - 17:00</option>
                                            <option value="17:00-18:00">17:00 - 18:00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xl font-semibold text-gray-700 mb-2">Nombres Completos *</label>
                                <input type="text" name="nombre" value=" {{ auth()->user()->name }}"
                                    placeholder="Ingrese sus nombres"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xl font-semibold text-gray-700 mb-2">Teléfono *</label>
                                        <input type="text" name="telefono" placeholder="Ingrese su teléfono" required
                                            pattern="\d{9}" title="Ingrese un número de teléfono válido de 9 dígitos"
                                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300">
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xl font-semibold text-gray-700 mb-2">Correo electrónico
                                            *</label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                                            placeholder="Ingrese su correo"
                                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xl font-semibold text-gray-700 mb-2">DNI*</label>
                                <input type="text" name="dni" placeholder="Ingrese su DNI"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300" required>
                            </div>
                            <div id="envioDomicilioFields" class="hidden space-y-4">
                                <div>
                                    <label class="block text-xl font-semibold text-gray-700 mb-2">Dirección *</label>
                                    <input type="text" name="direccion" placeholder="Ingrese su dirección"
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300" required>
                                </div>

                                <div>
                                    <label class="block text-xl font-semibold text-gray-700 mb-2">Referencia *</label>
                                    <input type="text" name="referencia" placeholder="Ingrese una referencia"
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xl font-semibold text-gray-700 mb-2">Observaciones</label>
                                <textarea name="observaciones" placeholder="Ingrese cualquier observación aquí..."
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-red-300"></textarea>
                            </div>

                            <!-- Campos ocultos para los productos -->
                            @foreach ($productos as $producto)
                                <input type="hidden" name="productos[{{ $producto->id }}][product_id]"
                                    value="{{ $producto->id }}" />
                                <input type="hidden" name="productos[{{ $producto->id }}][product_title]"
                                    value="{{ $producto->nombre }}" />
                                <input type="hidden" name="productos[{{ $producto->id }}][product_price]"
                                    value="{{ $producto->precio }}" />
                                <input type="hidden" name="productos[{{ $producto->id }}][cantidad]"
                                    value="{{ $carrito[$producto->id]['cantidad'] }}" />
                            @endforeach

                            <!-- Botón para finalizar pedido -->
                            <button type="button" id="pay-button"
                                class="w-full py-4 rounded-lg text-white bg-green-600 text-lg font-bold hover:bg-green-700 transition-all duration-300 mt-6">
                                Pagar pedido
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Columna derecha: Resumen del Pedido -->
                <div class="ml-0 mt-6 max-w-3xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="text-2xl font-bold text-center text-gray-900 mb-6">Su Pedido</div>

                        @if (count($carrito) > 0)
                            @foreach ($productos as $producto)
                                <div class="bg-white rounded-lg shadow-md p-6 flex items-center mb-4">
                                    <!-- Imagen del Producto -->
                                    <img src="{{ asset('imagenes/productos/' . $producto->imagen) }}"
                                        alt="{{ $producto->nombre }}" class="w-20 h-20 rounded-lg object-cover mr-6">

                                    <!-- Información del Producto -->
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $producto->nombre }}</h3>
                                        <p class="text-gray-500">Cantidad: {{ $carrito[$producto->id]['cantidad'] }}</p>
                                    </div>

                                    <!-- Precio Total por Producto -->
                                    <span class="text-xl font-bold text-red-500">
                                        S/. {{ number_format($producto->precio * $carrito[$producto->id]['cantidad'], 2) }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-lg text-gray-700">No hay productos en tu pedido.</p>
                        @endif

                        <!-- Totales -->
                        <div class="border-t border-b py-4 mt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-xl">Total Parcial</span>
                                <span class="font-bold text-xl">
                                    S/. {{ number_format($total, 2) }}
                                </span>
                            </div>

                            @if ($cuponAplicado)
                                <div class="flex justify-between mb-2">
                                    <span class="text-xl">Descuento ({{ $cuponAplicado['porcentaje'] }}%)</span>
                                    <span class="font-bold text-xl text-green-600">
                                        -S/. {{ number_format($cuponAplicado['descuento'], 2) }}
                                    </span>
                                </div>
                            @endif

                            <div class="flex justify-between mb-2" id="envioField">
                                <span class="text-xl">Envío</span>
                                <span class="font-bold text-xl" id="envioText">
                                    Recoge en Local
                                </span>
                            </div>
                        </div>

                        <!-- Total final -->
                        <div class="flex justify-between text-2xl font-extrabold text-red-600 mt-4">
                            <span class="text-xl">TOTAL</span>
                            <span class="font-bold text-xl" id="totalField">
                                S/. {{ number_format($totalFinal, 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Incluir el SDK de Mercado Pago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        function toggleEnvío() {
            const envioOption = document.querySelector('input[name="opcion_envio"]:checked').id;
            const envioDomicilioFields = document.getElementById('envioDomicilioFields');
            const tarifaEnvioFields = document.getElementById('tarifaEnvioFields');
            const envioText = document.getElementById('envioText');
            const totalField = document.getElementById('totalField');

            const totalOriginal = parseFloat('{{ $total }}');
            let totalFinal = parseFloat('{{ $totalFinal }}');

            if (envioOption === 'enviar') {
                envioDomicilioFields.classList.remove('hidden');
                tarifaEnvioFields.classList.remove('hidden');

                // Actualizar texto de envío y añadir tarifa
                envioText.innerHTML = 'Delivery S/ 6.00';
                totalFinal += 6.00;
                totalField.innerHTML = 'S/. ' + totalFinal.toFixed(2);
            } else {
                envioDomicilioFields.classList.add('hidden');
                tarifaEnvioFields.classList.add('hidden');

                // Revertir a recogida en local
                envioText.innerHTML = 'Recoge en Local';
                totalField.innerHTML = 'S/. ' + totalFinal.toFixed(2);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 2);

            const year = tomorrow.getFullYear();
            const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
            const day = String(tomorrow.getDate()).padStart(2, '0');

            const formattedDate = `${year}-${month}-${day}`;
            const dateInput = document.querySelector('input[name="fecha_entrega"]');
            dateInput.setAttribute('min', formattedDate);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Mercado Pago con tu clave pública
            const form = document.getElementById('payment-form');
            const deliveryOptions = document.querySelectorAll('input[name="opcion_envio"]');
            const envioDomicilioFields = document.getElementById('envioDomicilioFields');

            // Function to validate the entire form
            function validateForm() {
                // Basic field validations
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                // Reset previous error messages
                document.querySelectorAll('.error-message').forEach(el => el.remove());

                // Check all required fields
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        showError(field, 'Este campo es obligatorio');
                        isValid = false;
                    }
                });

                // Validate telephone number
                const telefonoInput = form.querySelector('input[name="telefono"]');
                if (telefonoInput.value.trim() && !/^\d{9}$/.test(telefonoInput.value)) {
                    showError(telefonoInput, 'Ingrese un número de teléfono válido de 9 dígitos');
                    isValid = false;
                }

                // Validate DNI
                const dniInput = form.querySelector('input[name="dni"]');
                if (dniInput.value.trim() && !/^\d{8}$/.test(dniInput.value)) {
                    showError(dniInput, 'Ingrese un DNI válido de 8 dígitos');
                    isValid = false;
                }

                // Check if delivery is selected
                const deliveryOption = document.querySelector('input[name="opcion_envio"]:checked').id;
                if (deliveryOption === 'enviar') {
                    // Additional validation for delivery option
                    const direccionInput = form.querySelector('input[name="direccion"]');
                    const referenciaInput = form.querySelector('input[name="referencia"]');

                    if (!direccionInput.value.trim()) {
                        showError(direccionInput, 'La dirección es obligatoria para envío a domicilio');
                        isValid = false;
                    }

                    if (!referenciaInput.value.trim()) {
                        showError(referenciaInput, 'La referencia es obligatoria para envío a domicilio');
                        isValid = false;
                    }
                }

                return isValid;
            }

            // Function to show error messages
            function showError(field, message) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                errorDiv.textContent = message;

                // Insert error message after the input
                field.parentNode.insertBefore(errorDiv, field.nextSibling);

                // Highlight the input field
                field.classList.add('border-red-500');

                // Remove highlight when user starts typing
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                    const errorMsg = this.parentNode.querySelector('.error-message');
                    if (errorMsg) errorMsg.remove();
                });
            }

            // Modify pay button to include validation
            const payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    Swal2.fire({
                        icon: 'error',
                        title: 'Erro de Validación',
                        text: 'Por favor complete todos los campos obligatorios correctamente.',
                        confirmButtonText: 'Entendido'
                    });
                    return false;
                }

                // If validation passes, proceed with payment
                // The existing Mercado Pago logic will handle the payment
            });

            // Toggle delivery fields visibility and validation
            deliveryOptions.forEach(option => {
                option.addEventListener('change', function() {
                    const isDelivery = this.id === 'enviar';

                    // Toggle delivery fields
                    const direccionInput = form.querySelector('input[name="direccion"]');
                    const referenciaInput = form.querySelector('input[name="referencia"]');

                    if (isDelivery) {
                        envioDomicilioFields.classList.remove('hidden');
                        direccionInput.setAttribute('required', 'required');
                        referenciaInput.setAttribute('required', 'required');
                    } else {
                        envioDomicilioFields.classList.add('hidden');
                        direccionInput.removeAttribute('required');
                        referenciaInput.removeAttribute('required');
                    }
                });
            });
        






        const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}");

        document.getElementById('pay-button').addEventListener('click', function() {
        // Recopila datos básicos
        const productos = [
            @foreach ($productos as $producto)
                {
                    id: "{{ $producto->id }}",
                    title: "{{ $producto->nombre }}",
                    quantity: {{ $carrito[$producto->id]['cantidad'] }},
                    unit_price: {{ $producto->precio }}
                },
            @endforeach
        ];

        // Enviar datos para crear preferencia
        fetch('{{ route('create.preference') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },
                body: JSON.stringify({
                    productos: productos
                })
            })
            .then(response => response.json())
            .then(preference => {
                // Abrir el checkout de Mercado Pago
                mp.checkout({
                    preference: {
                        id: preference.id
                    },
                    autoOpen: true
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('No se pudo procesar el pago');
            });
        });
        });
    </script>

    <script>
        const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}");
        console.log("Public Key:", "{{ config('services.mercadopago.public_key') }}");
    </script>





    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            animation: shake 0.5s;
        }

        .border-red-500 {
            border-color: red;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }
    </style>

@endsection
