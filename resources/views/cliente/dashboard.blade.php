<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard de Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("¡Bienvenido a tu dashboard, ") . auth()->user()->name . "!" }}
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Tus Datos</h3>
                    <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    @if(auth()->user()->cliente)
                        <p><strong>Dirección:</strong> {{ auth()->user()->cliente->direccion }}</p>
                        <p><strong>Teléfono:</strong> {{ auth()->user()->cliente->telefono }}</p>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>