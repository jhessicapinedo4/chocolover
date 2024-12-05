@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Información de categoría</h3>
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
                <a href="{{ route('categorias.index') }}">
                    <div class="text-tiny">Categorías</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Nueva categoría</div>
            </li>
        </ul>
    </div>

    <!-- Mostrar alertas específicas de los errores -->
    @if ($errors->has('nombre'))
        <x-alert type="danger" message="{{ $errors->first('nombre') }}" />
    @endif

    @if ($errors->has('imagen'))
        <x-alert type="danger" message="{{ $errors->first('imagen') }}" />
    @endif

    <!-- Mostrar alerta de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="name">
                <div class="body-title">Nombre de la categoría <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Nombre de la categoría" name="nombre" tabindex="0"
                    value="{{ old('nombre') }}" aria-required="true" required>
            </fieldset>
            <fieldset class="name">
                <div class="body-title">Descripción (opcional)</div>
                <input class="flex-grow" type="text" placeholder="Descripción de la categoría" name="descripcion" tabindex="0"
                    value="{{ old('descripcion') }}">
            </fieldset>
            <fieldset>
                <div class="body-title">Seleccione una imagen <span class="tf-color-1">*</span></div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="display:none">
                        <img id="preview" src="#" class="effect8" alt="Previsualización de la imagen" style="max-width: 100%; height: auto;" required>
                    </div>
                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Suelta tus imágenes <span class="tf-color">o haz clic aquí</span></span>
                            <input required type="file" id="myFile" name="imagen" accept="image/*"  onchange="previewImage(event)" >
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="bot">
                <button class="tf-button w208" type="submit">Guardar</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado
            if (file) {
                const reader = new FileReader(); // Crea un lector de archivos
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('imgpreview'); // Div que contiene la imagen
                    const preview = document.getElementById('preview'); // Elemento img para la previsualización
                    preview.src = e.target.result; // Asigna la URL de la imagen al src
                    imgPreview.style.display = 'block'; // Muestra el contenedor de la imagen
                };
                reader.readAsDataURL(file); // Lee el archivo como una URL de datos
            }
        }
    </script>
@endsection
