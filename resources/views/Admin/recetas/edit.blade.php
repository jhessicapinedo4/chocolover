@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Editar Receta</h3>
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
                <a href="{{ route('recetas.index') }}">
                    <div class="text-tiny">Recetas</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Editar Receta</div>
            </li>
        </ul>
    </div>

    <!-- Mensajes de error y éxito -->
    <x-alert type="success" />
    <x-alert type="error" />

    <!-- Formulario -->
    <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{ route('recetas.update', $receta->id) }}">
        @csrf
        @method('PUT')
        <div class="wg-box">
            <fieldset class="name">
                <div class="body-title mb-10">Nombre de la Receta <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Escriba el nombre de la receta" name="nombre" value="{{ old('nombre', $receta->nombre) }}" required>
            </fieldset>

            <fieldset class="description">
                <div class="body-title mb-10">Descripción <span class="tf-color-1">*</span></div>
                <textarea name="descripcion" placeholder="Descripción de la receta" required>{{ old('descripcion', $receta->descripcion) }}</textarea>
            </fieldset>

            <fieldset class="description">
                <div class="body-title mb-10">Ingredientes <span class="tf-color-1">*</span></div>
                <textarea name="ingredientes" placeholder="Lista de ingredientes" required>{{ old('ingredientes', $receta->ingredientes) }}</textarea>
            </fieldset>

            

          
        </div>

        <div class="wg-box">

          <fieldset class="description">
                <div class="body-title mb-10">Preparación <span class="tf-color-1">*</span></div>
                <textarea name="preparacion" placeholder="Pasos de preparación" required>{{ old('preparacion', $receta->preparacion) }}</textarea>
            </fieldset>
            <fieldset>
                <div class="body-title">Imagen de la Receta <span class="tf-color-1">*</span></div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="{{ $receta->imagen ? 'display:block;' : 'display:none;' }}">
                        <img id="preview" src="{{ $receta->imagen ? asset('storage/' . $receta->imagen) : '#' }}" class="effect8" alt="Previsualización de la imagen" style="max-width: 100%; height: auto;">
                    </div>
                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Suelta tus imágenes aquí o haz clic para buscar</span>
                            <input type="file" id="myFile" name="imagen" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset class="description">
                <div class="body-title mb-10">Mensaje Final <span class="tf-color-1">*</span></div>
                
                 <textarea name="mensaje_final" placeholder="Mensaje final de la receta" required>{{ old('mensaje_final', $receta->mensaje_final) }}</textarea>
            </fieldset>
            </fieldset>

            </fieldset>

            <button class="tf-button w-full" type="submit">Actualizar Receta</button>
        </div>
    </form>

    <!-- Script para la previsualización -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('imgpreview');
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    imgPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection