<div class="product-single__reviews-list">
    <div id="reviews-list">
        @foreach ($producto->calificaciones as $calificacion)
            <div class="product-single__reviews-item d-flex mb-3">
                <div class="customer-avatar me-3">
                    <img loading="lazy" src="../imagenes/user/usuario.png" alt="Avatar del cliente" />
                </div>

                <div class="customer-review w-100">
                    <div class="customer-name d-flex justify-content-between">
                        <!-- Mostrar el nombre del cliente -->
                        <h6>{{ $calificacion->cliente->user->name ?? 'Anónimo' }}</h6> <!-- Usamos cliente->user->name para obtener el nombre -->
                        
                        <div class="reviews-group d-flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                @if ($i > $calificacion->calificacion-1)
                                    @break
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="review-date text-muted">{{ \Carbon\Carbon::parse($calificacion->created_at)->locale('es')->isoFormat('LL') }}
</div>
                    <div class="review-text">
                        <p>{{ $calificacion->comentario ?? 'Sin comentario' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
