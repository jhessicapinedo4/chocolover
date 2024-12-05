@push('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Calificaciones</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="index.html">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Calificaciones</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <x-search-form :action="route('admin.calificaciones.index')" :searchValue="request('search')" />

        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Producto</th>
                            <th>Cliente</th>
                            <th class="text-center">Calificación</th>
                            <th class="text-center">Comentario</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calificaciones as $calificacion)
                            <tr>
                                <td class="text-center">{{ $calificacion->id }}</td>
                                <td>{{ $calificacion->producto->nombre }}</td>
                                <td>{{ $calificacion->cliente->user->name }}</td>
                                <td class="text-center">
                                   
                                    <span>{{ $calificacion->calificacion }}</span>
                                </td>
                                <td class="text-center">{{ Str::limit($calificacion->comentario, 50, '...') }}</td>
                                <td class="text-center">{{ $calificacion->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.calificaciones.destroy', $calificacion->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta calificación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
