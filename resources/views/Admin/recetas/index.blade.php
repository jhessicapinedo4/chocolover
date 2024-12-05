@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Todas las recetas</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Todas las recetas</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <!-- Componente de búsqueda y botón -->
        <x-search-form :action="route('recetas.index')" :searchValue="request('nombre')" :showAddButton="true" :addButtonRoute="route('recetas.create')" />

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recetas as $receta)
                        <tr>
                            <td>{{ $receta->id }}</td>
                            <td class="nombre">
                                <a href="#" class="body-title-2">{{ $receta->nombre }}</a>
                            </td>
                            <td>{{ Str::limit($receta->descripcion, 50) }}</td>
                            <td>
                                @if($receta->imagen)
                                    <div class="image">
                                        <img src="{{ asset('imagenes/recetas/' . $receta->imagen) }}" alt="Imagen de {{ $receta->nombre }}" class="image" style="width: 100px; height: auto;">
                                    </div>
                                @else
                                    <p class="text-gray-600">Sin imagen</p>
                                @endif
                            </td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('recetas.show', $receta->id) }}">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('recetas.edit', $receta->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>

                                    <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron recetas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $recetas->links() }}
        </div>
    </div>
@endsection
