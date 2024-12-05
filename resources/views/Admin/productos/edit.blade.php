@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Editar Producto</h3>
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
                <a href="{{ route('productos.index') }}">
                    <div class="text-tiny">Productos</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Editar Producto</div>
            </li>
        </ul>
    </div>

    <!-- Mensajes de error y éxito -->
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

    <!-- Formulario -->
    <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
          action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')
        <div class="wg-box">
            <fieldset class="name">
                <div class="body-title mb-10">Nombre del producto <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Escriba el nombre del producto" name="nombre"
                       value="{{ old('nombre', $producto->nombre) }}" required>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Slug (URL)" name="slug"
                       value="{{ old('slug', $producto->slug) }}" required>
            </fieldset>

            <fieldset class="category">
                <div class="body-title mb-10">Categoría <span class="tf-color-1">*</span></div>
                <div class="select">
                    <select name="categoria_id" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </fieldset>

            <fieldset class="description">
                <div class="body-title mb-10">Descripción <span class="tf-color-1">*</span></div>
                <textarea name="descripcion" placeholder="Descripción del producto" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Popular</div>
                <div class="select mb-10">
                    <select name="popular">
                        <option value="1" {{ old('popular', $producto->popular) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('popular', $producto->popular) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </fieldset>
        </div>

        <div class="wg-box">
            <fieldset>
                <div class="body-title">Imagen del producto</div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="{{ $producto->imagen ? 'display:block;' : 'display:none;' }}">
                        <img id="preview"
                             src="{{ $producto->imagen ? asset('imagenes/productos/' . $producto->imagen) : '#' }}"
                             class="effect8"
                             alt="Previsualización de la imagen"
                             style="max-width: 100%; height: auto;">
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

            <fieldset class="name">
                <div class="body-title mb-10">Precio <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="number" name="precio" step="0.01" placeholder="Ingrese el precio"
                       value="{{ old('precio', $producto->precio) }}" required>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Estado</div>
                <div class="select mb-10">
                    <select name="estado">
                        <option value="1" {{ $producto->estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $producto->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Personalizable</div>
                <div class="select mb-10">
                    <select name="personalizable">
                        <option value="1" {{ $producto->personalizable == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ $producto->personalizable == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </fieldset>

            <button class="tf-button w-full" type="submit">Actualizar Producto</button>
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
