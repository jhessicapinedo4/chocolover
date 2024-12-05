import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.getElementById("user-icon");
    const modal = document.getElementById("login-modal");
    const closeModal = document.getElementById("close-modal");
    const togglePassword = document.getElementById("toggle-password");
    const passwordInput = document.getElementById("password");

    // Mostrar el modal al hacer clic en el icono de usuario
    userIcon.addEventListener("click", () => {
        modal.classList.add("show");
    });

    // Ocultar el modal al hacer clic en el botón de cerrar
    closeModal.addEventListener("click", () => {
        modal.classList.remove("show");
    });

    // Ocultar el modal al hacer clic fuera del contenido
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });

    // Alternar visibilidad de la contraseña
    togglePassword.addEventListener("click", () => {
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);
        togglePassword.classList.toggle("bi-eye-slash");
    });
});

//AQUI LO CATEGORIASSSSSS SU CARRUSEL

document.addEventListener("DOMContentLoaded", () => {
    const swiperWrapper = document.querySelector(".swiper-wrapper");
    const swiperSlides = document.querySelectorAll(".swiper-slide");
    const prevButton = document.getElementById("prevBtn");
    const nextButton = document.getElementById("nextBtn");

    let slidesToShow = 4; // Número de imágenes visibles por defecto
    const totalSlides = swiperSlides.length;
    let currentIndex = slidesToShow; // Comienza después de los clones iniciales

    // Clonar diapositivas al inicio y al final para bucle infinito
    const cloneSlides = () => {
        swiperSlides.forEach((slide) => {
            const cloneBefore = slide.cloneNode(true); // Clona para el inicio
            const cloneAfter = slide.cloneNode(true); // Clona para el final
            swiperWrapper.appendChild(cloneAfter); // Agrega al final
            swiperWrapper.insertBefore(cloneBefore, swiperSlides[0]); // Agrega al inicio
        });
    };

    // Calcula el número de diapositivas visibles según el tamaño de pantalla
    const calculateSlidesToShow = () => {
        const screenWidth = window.innerWidth;
        if (screenWidth <= 750) {
            slidesToShow = 1; // 1 imagen visible en móviles
        } else if (screenWidth <= 1080) {
            slidesToShow = 3; // 3 imágenes visibles en tablets
        } else {
            slidesToShow = 4; // 4 imágenes visibles en pantallas grandes
        }
        currentIndex = slidesToShow; // Ajusta el índice inicial después del redimensionamiento
    };

    // Ajusta el ancho de cada diapositiva considerando los gaps
    const updateSlideWidth = () => {
        const gap = 4; // Define el espacio entre diapositivas (en px)
        const slideWidth =
            (swiperWrapper.offsetWidth - gap * (slidesToShow - 1)) /
            slidesToShow;
        const allSlides = document.querySelectorAll(".swiper-slide"); // Incluye los clones
        allSlides.forEach((slide) => {
            slide.style.flex = `0 0 ${slideWidth}px`; // Ajusta el ancho dinámicamente
        });

        // Ajusta el desplazamiento inicial
        swiperWrapper.style.transform = `translateX(${
            -currentIndex * slideWidth - gap * currentIndex
        }px)`;
    };

    // Actualiza el carrusel
    const updateCarousel = () => {
        const gap = 4; // Define el espacio entre diapositivas
        const slideWidth =
            (swiperWrapper.offsetWidth - gap * (slidesToShow - 1)) /
            slidesToShow;
        swiperWrapper.style.transition = "transform 0.5s ease-in-out";
        swiperWrapper.style.transform = `translateX(${
            -currentIndex * slideWidth - gap * currentIndex
        }px)`;
    };

    // Restaura la posición después de completar el bucle
    const resetCarousel = () => {
        const gap = 4; // Define el espacio entre diapositivas
        const slideWidth =
            (swiperWrapper.offsetWidth - gap * (slidesToShow - 1)) /
            slidesToShow;

        if (currentIndex === 0) {
            // Si estamos en el primer clon, salta al final real
            currentIndex = totalSlides;
            swiperWrapper.style.transition = "none"; // Elimina la animación
            swiperWrapper.style.transform = `translateX(${
                -currentIndex * slideWidth - gap * currentIndex
            }px)`;
        }

        if (currentIndex === totalSlides + slidesToShow) {
            // Si estamos en el último clon, salta al inicio real
            currentIndex = slidesToShow;
            swiperWrapper.style.transition = "none"; // Elimina la animación
            swiperWrapper.style.transform = `translateX(${
                -currentIndex * slideWidth - gap * currentIndex
            }px)`;
        }
    };

    // Botón "Siguiente"
    nextButton.addEventListener("click", () => {
        currentIndex++;
        updateCarousel();
        setTimeout(resetCarousel, 500); // Verifica si es necesario reiniciar después de la transición
    });

    // Botón "Anterior"
    prevButton.addEventListener("click", () => {
        currentIndex--;
        updateCarousel();
        setTimeout(resetCarousel, 500); // Verifica si es necesario reiniciar después de la transición
    });

    // Ajusta el carrusel al redimensionar la ventana
    window.addEventListener("resize", () => {
        calculateSlidesToShow();
        updateSlideWidth();
    });

    // Inicialización
    cloneSlides();
    calculateSlidesToShow();
    updateSlideWidth();
});



