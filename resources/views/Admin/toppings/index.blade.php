@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Toppings</h3>
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
                <div class="text-tiny">Toppings</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <x-search-form :action="route('toppings.index')" :searchValue="request('search')" 
    :showAddButton="true" :addButtonRoute="route('toppings.create')" />




        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($toppings as $topping)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $topping->nombre }}</td>
                            <td>{{ $topping->descripcion ?? 'Sin descripción' }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('toppings.edit', $topping->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>

                                    <form action="{{ route('toppings.destroy', $topping->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este topping?');"
                                        style="display:inline-block;">
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
                            <td colspan="4" class="text-center">No hay toppings disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $toppings->links() }}
        </div>
    </div>
@endsection
