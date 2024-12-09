<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Personal Information Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Información Personal') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Actualiza la información de tu perfil.") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('profile_cliente.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Correo Electrónico')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                    :value="old('email', $user->email)" required autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="direccion" :value="__('Dirección')" />
                                <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" 
                                    :value="old('direccion', $cliente->direccion ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
                            </div>

                            <div>
                                <x-input-label for="telefono" :value="__('Teléfono')" />
                                <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" 
                                    :value="old('telefono', $cliente->telefono ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
                            </div>

                            <div>
                                <x-input-label for="dni" :value="__('DNI')" />
                                <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" 
                                    :value="old('dni', $cliente->dni ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Delete Account Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Eliminar Cuenta') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente.') }}
                            </p>
                        </header>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >{{ __('Eliminar Cuenta') }}</x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile_cliente.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('¿Está seguro de que desea eliminar su cuenta?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Contraseña') }}"
                                    />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancelar') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Eliminar Cuenta') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>