@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Todos los productos</h3>
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
                <div class="text-tiny">Todos los productos</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">

      
        <x-search-form :action="route('productos.index')" :searchValue="request('search')" :showAddButton="true" :addButtonRoute="route('productos.create')" />


        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Personalizable</th>
                        <th>Slug</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <!-- Mostrar el ID real del producto -->
                            <td>{{ $producto->id }}</td>
                            <td class="nombre">
                                <a href="#" class="body-title-2">{{ $producto->nombre }}</a>
                            </td>
                            <td>S/. {{ number_format($producto->precio, 2) }}</td>
                            <td>
                                <div class="image">
                                    <img src="{{ asset('imagenes/productos/' . $producto->imagen) }}"
                                        alt="Imagen de {{ $producto->nombre }}" class="image"
                                        style="width: 100px; height: auto;">
                                </div>
                            </td>
                            <td>{{ $producto->personalizable ? 'Sí' : 'No' }}</td>
                            <td>{{ $producto->slug }}</td>
                            <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('productos.show', $producto->id) }}">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('productos.edit', $producto->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No se encontraron productos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $productos->links() }}
        </div>
    </div>
@endsection
