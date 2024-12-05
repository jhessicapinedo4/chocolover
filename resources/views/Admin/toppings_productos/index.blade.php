@extends('layouts.admin')
{{-- //TABLAAAAA --}}
@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Relación Producto - Toppings</h3>
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
                <div class="text-tiny">Relación Producto - Toppings</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
      
        <x-search-form :action="route('producto_toppings.index')" :searchValue="request('search')" :showAddButton="true" :addButtonRoute="route('productos.asignar_toppings')" />

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Toppings</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="#" class="body-title-2">{{ $producto->nombre }}</a>
                            </td>
                            <td>
                                @forelse ($producto->toppings as $topping)
                                    <span class="badge bg-primary">{{ $topping->nombre }}</span>
                                @empty
                                    <span class="text-muted">Sin toppings</span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No se encontraron resultados</td>
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
