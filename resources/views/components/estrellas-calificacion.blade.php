@php
    $promedioEstrellas = $producto->calificaciones->avg('calificacion')-1; // Promedio de calificación
    $estrellas = round($promedioEstrellas); // Redondear el promedio de estrellas
@endphp

@if ($estrellas > 0) <!-- Solo mostrar si la calificación es mayor a 0 -->
    <div class="reviews-group d-flex">
        @for ($i = 1; $i <= 5; $i++)
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_star" />
            </svg>
            @if ($i > $estrellas)
                @break
            @endif
        @endfor
    </div>
@endif
