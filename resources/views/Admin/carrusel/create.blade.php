@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Nuevo Slider</h3>
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
                    <div class="text-tiny">Slider</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Nuevo Slider</div>
            </li>
        </ul>
    </div>

    <!-- Mostrar alertas específicas de los errores -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" message="{{ $error }}" />
        @endforeach
    @endif

    <!-- Mostrar alerta de éxito -->
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('carrusel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="name">
                <div class="body-title">Descripción <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Descripción" name="descripcion" value="{{ old('descripcion') }}" required>
            </fieldset>

            <fieldset class="name">
                <div class="body-title">Orden <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="number" placeholder="Orden" name="orden" value="{{ old('orden') }}" required>
            </fieldset>

            <fieldset>
                <div class="body-title">Subir imagen <span class="tf-color-1">*</span></div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="display:none">
                        <img id="preview" src="#" class="effect8" alt="Previsualización de la imagen" style="max-width: 100%; height: auto;">
                    </div>
                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="imagen">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Arrastra tus imágenes aquí o selecciona <span class="tf-color">haz clic para buscar</span></span>
                            <input type="file" id="imagen" name="imagen" accept="image/*" required onchange="previewImage(event)">
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
