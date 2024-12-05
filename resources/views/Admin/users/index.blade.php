@push('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Users</h3>
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
                <div class="text-tiny">Todos los usuarios</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
       
       <x-search-form :action="route('users.index')" :searchValue="request('name')" 
    :showAddButton="true" :addButtonRoute="route('users.create')"  />

    
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Teléfono</th>
                            <th class="mail">Email</th>
                            <th>Dirección</th>          
                            <th class="text-center">Ordenes totales</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td class="pname">
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{ $usuario->name }}</a>
                                        <div class="text-tiny mt-3">{{ $usuario->role }}</div>
                                    </div>
                                </td>
                                <td>{{ $usuario->cliente ? $usuario->cliente->telefono : 'N/A' }}</td>
                                <td class="mail">{{ $usuario->email }}</td>
                                <td>{{ $usuario->cliente ? $usuario->cliente->direccion : 'N/A' }}</td>
                                {{-- Total Orders --}}
                                <td class="text-center"><a href="#" target="_blank">0</a></td>

                                <td>
                                    <div class="list-icon-function content-center">
                                        <form action="{{ route('users.destroy', $usuario->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este USUARIO?');">
                                            @csrf
                                            @method('DELETE') <!-- Método DELETE -->
                                            <button class="item text-danger delete">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('users.show', $usuario->id) }}">

                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
