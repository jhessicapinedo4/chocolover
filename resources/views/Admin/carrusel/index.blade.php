@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Carrusel</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Carrusel</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="flex items-center justify-between gap-10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" action="{{ route('carrusel.index') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" placeholder="Buscar aquí..." class="" name="descripcion" tabindex="2"
                            value="{{ request()->input('descripcion') }}" aria-required="true" required>
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('carrusel.create') }}"><i class="icon-plus"></i>Agregar
                nuevo</a>
        </div>

        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Orden</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carruseles as $carrusel)
                        <tr>
                            <td>{{ $carrusel->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ asset('imagenes/carrusel/' . $carrusel->imagen) }}"
                                        alt="{{ $carrusel->descripcion }}" class="image">
                                </div>
                            </td>
                            <td>{{ $carrusel->descripcion }}</td>
                            <td>{{ $carrusel->orden }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('carrusel.show', $carrusel->id) }}">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('carrusel.edit', $carrusel->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>


                                    <form action="{{ route('carrusel.destroy', $carrusel->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>

                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="divider"></div>

        <div class="flex items-center justify-between flex-wrap gap-10 wgp-pagination">
            {{ $carruseles->links() }} <!-- Paginación -->
        </div>
    </div>
@endsection
