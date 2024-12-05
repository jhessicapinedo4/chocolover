@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Categorías</h3>
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
                <div class="text-tiny">Categorías</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <x-search-form :action="route('categorias.index')" :searchValue="request('name')" 
    :showAddButton="true" :addButtonRoute="route('categorias.create')" :fieldName="'name'" />



        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="nombre">
                                    <a href="#" class="body-title-2">{{ $categoria->nombre }}</a>
                                </div>
                            </td>

                            <td>
                                <div>
                                    {{ $categoria->description ?? 'No disponible' }}
                                </div>
                            </td>
                            <td>
                                <div class="image">
                                    <img src="{{ asset('imagenes/categorias/' . $categoria->imagen) }}"
                                        alt="Imagen de {{ $categoria->nombre }}" class="image">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{ $categoria->estado ? 'Activo' : 'Inactivo' }}
                                </div>
                            </td>
                            <td>
                                <div class="list-icon-function">

                                    <a href="{{ route('categorias.show', $categoria->id) }}">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('categorias.edit', $categoria->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron categorías</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $categorias->links() }}
        </div>
    </div>
@endsection
