<form method="POST" action="{{ route('calificacion.store') }}" name="customer-review-form" id="review-form">
    @csrf
    <h5>¡Anímate a valorar este producto!</h5>
    <p>Nos ayudarían mucho tus calificaciones para poder mejorar.</p>

    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
    <input type="hidden" name="calificacion" id="form-input-rating" value="" /> <!-- Calificación oculta -->

    <div class="select-star-rating">
        <label for="calificacion">Tu calificación *</label>
        <span class="star-rating" style="display: flex; gap: 5px;">
            @for ($i = 1; $i <= 5; $i++)
                <x-estrellita class="star" width="16" height="16" data-value="{{ $i }}" />
            @endfor
        </span>
    </div>

    <div class="mb-4">
        <textarea name="comentario" id="form-input-review" class="form-control form-control_gray" placeholder="Tu comentario" cols="30" rows="8"></textarea>
    </div>

    <div class="form-action">
        <button type="submit" class="btn btn-primary" id="submit-review-btn">Enviar</button>
    </div>
</form>

<script>
    document.getElementById('submit-review-btn').addEventListener('click', function(event) {
        // Verifica si el usuario está autenticado
        if (!{{ Auth::check() ? 'true' : 'false' }}) {
            event.preventDefault();  // Evita que se envíe el formulario
            window.location.href = "{{ route('cliente.login') }}";  // Redirige al login
        }
    });
</script>
