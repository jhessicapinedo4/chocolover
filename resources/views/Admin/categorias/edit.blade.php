@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Editar Categoría</h3>
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
                <div class="text-tiny">Editar Categoría</div>
            </li>
        </ul>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <fieldset class="name">
                <div class="body-title">Nombre de la categoría <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Nombre de la categoría" name="nombre" tabindex="0"
                    value="{{ old('nombre', $categoria->nombre) }}" aria-required="true" required>
            </fieldset>
            
            <fieldset class="name">
                <div class="body-title">Descripción (opcional)</div>
                <input class="flex-grow" type="text" placeholder="Descripción de la categoría" name="description" tabindex="0"
                    value="{{ old('descripcion', $categoria->description) }}">
            </fieldset>

            <!-- Campo para editar el slug -->
            <fieldset class="name">
                <div class="body-title">Slug (opcional)</div>
                <input class="flex-grow" type="text" placeholder="Slug de la categoría" name="slug" tabindex="0"
                    value="{{ old('slug', $categoria->slug) }}">
            </fieldset>

            <fieldset>
                <div class="body-title">Seleccione una imagen <span class="tf-color-1">*</span></div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="{{ $categoria->imagen ? 'display:block;' : 'display:none;' }}">
                        <img id="preview" src="{{ $categoria->imagen ? asset('imagenes/categorias/' . $categoria->imagen) : '#' }}" 
                            class="effect8" alt="Previsualización de la imagen" style="max-width: 100%; height: auto;">
                    </div>
                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Suelta tus imágenes <span class="tf-color">o haz clic aquí</span></span>
                            <input type="file" id="myFile" name="imagen" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                </div>
            </fieldset>
            
            <fieldset class="name">
                <div class="body-title">Estado <span class="tf-color-1">*</span></div>
                <select class="flex-grow" name="estado" tabindex="0" required>
                    <option value="1" {{ $categoria->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$categoria->estado ? 'selected' : '' }}>Inactivo</option>
                </select>
            </fieldset>
            
            <div class="bot">
                <button class="tf-button w208" type="submit">Actualizar</button>
            </div>
        </form>
    </div>

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
