{{-- <div id="registerModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50  flex justify-center items-center">
    <div class="relative w-full max-w-lg mx-auto p-8 bg-white rounded-3xl shadow-lg">
        <!-- Cerrar modal -->
        <button id="closeModalBtn" class="absolute top-4 right-4 text-3xl text-gray-600 hover:text-gray-900 transition-colors duration-300 ease-in-out">&times;</button>

        <h2 class="text-3xl font-semibold text-center text-blue-600 mb-6">{{ __('Registrar Cuenta') }}</h2>

        <form method="POST" action="{{ route('cliente.register') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-6">
                <x-input-label for="name" :value="__('Nombre')" class="text-lg text-gray-700" />
                <x-text-input 
                    id="name" 
                    class="block w-full mt-2 p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105 hover:ring-4 hover:ring-blue-200" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="text-lg text-gray-700" />
                <x-text-input 
                    id="email" 
                    class="block w-full mt-2 p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105 hover:ring-4 hover:ring-blue-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Contraseña -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Contraseña')" class="text-lg text-gray-700" />
                <x-text-input 
                    id="password" 
                    class="block w-full mt-2 p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105 hover:ring-4 hover:ring-blue-200" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-8">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-lg text-gray-700" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block w-full mt-2 p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105 hover:ring-4 hover:ring-blue-200" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-gray-600 hover:text-blue-500 underline " href="{{ route('cliente.login') }}" style="font-size: 10px;">
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <x-primary-button class="px-8 py-3 text-white bg-blue-500 hover:bg-blue-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 ease-in-out transform hover:scale-110">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mostrar el modal al hacer clic en el ícono de usuario
    document.getElementById('openModalBtn').addEventListener('click', function () {
        document.getElementById('registerModal').classList.remove('hidden');
    });

    // Ocultar el modal al hacer clic en el botón de cerrar
    document.getElementById('closeModalBtn').addEventListener('click', function () {
        document.getElementById('registerModal').classList.add('hidden');
    });

    // Cerrar el modal si el usuario hace clic fuera del contenido del modal
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('registerModal');
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script> --}}
