@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Editar Carrusel</h3>
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
                <a href="{{ route('carrusel.index') }}">
                    <div class="text-tiny">Carrusel</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Editar Carrusel</div>
            </li>
        </ul>
    </div>

    <!-- Mostrar alertas específicas de los errores -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mostrar alerta de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('carrusel.update', $carrusel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <fieldset class="name">
                <div class="body-title">Descripción <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Descripción" name="descripcion" value="{{ old('descripcion', $carrusel->descripcion) }}" required>
            </fieldset>

            <fieldset class="name">
                <div class="body-title">Orden <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="number" placeholder="Orden" name="orden" value="{{ old('orden', $carrusel->orden) }}" required>
            </fieldset>

            <fieldset>
                <div class="body-title">Subir nueva imagen (opcional)</div>
                <div class="upload-image flex-grow">
                    <div class="item up-load">
                        <label class="uploadfile" for="imagen">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Arrastra tus imágenes aquí o selecciona <span class="tf-color">haz clic para buscar</span></span>
                            <input type="file" id="imagen" name="imagen">
                        </label>
                    </div>
                </div>

                <!-- Mostrar imagen actual -->
                @if($carrusel->imagen)
                    <div class="mt-4">
                        <p>Imagen actual:</p>
                        <img src="{{ asset('imagenes/carrusel/' . $carrusel->imagen) }}" alt="Imagen actual" class="w-32 h-32 object-cover">
                    </div>
                @else
                    <p>No hay imagen actual.</p>
                @endif
            </fieldset>

            <div class="bot">
                <button class="tf-button w208" type="submit">Actualizar</button>
            </div>
        </form>
    </div>

    <!-- Script para la previsualización de la imagen -->
    <script>
        // Si necesitas previsualizar la imagen subida
        document.getElementById('imagen').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-32', 'h-32', 'object-cover');
                    document.querySelector('.wg-box').appendChild(img); // Agrega la imagen a la vista previa
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
