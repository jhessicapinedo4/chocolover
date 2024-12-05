const todos = document.querySelector(".postre");
const navegacion = document.querySelector(".navegacion");
const imagenes = document.querySelectorAll("imagenes");

const btnTodos = document.querySelector(".todos");
const btnTorta = document.querySelector(".torta");
const btnPack = document.querySelector(".pack");
const btnBocadito = document.querySelector(".bocadito");
const btnDetalles = document.querySelector(".detalle");
const contenedorPlatillos = document.querySelector(".platillos");
document.addEventListener("DOMContentLoaded", () => {
    eventos();
    platillos();
});

const eventos = () => {
    todos.addEventListener("click", abrirTodos);
};

const abrirTodos = () => {
    navegacion.classList.remove("ocultar");
    botonCerrar();
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const imagen = entry.target;
            imagen.src = imagen.dataset.src;
            observer.unobserve(imagen);
        }
    });
});

imagenes.forEach((imagen) => {
    observer.observe(imagen);
});

const platillos = () => {
    let platillosArreglo = [];
    const platillos = document.querySelectorAll(".platillo");

    platillos.forEach(
        (platillo) => (platillosArreglo = [...platillosArreglo, platillo])
    );

    const tortas = platillosArreglo.filter(
        (torta) => torta.getAttribute("data-platillo") === "torta"
    );
    const packs = platillosArreglo.filter(
        (pack) => pack.getAttribute("data-platillo") === "pack"
    );
    const bocaditos = platillosArreglo.filter(
        (bocadito) => bocadito.getAttribute("data-platillo") === "bocadito"
    );
    const detalles = platillosArreglo.filter(
        (detalle) => detalle.getAttribute("data-platillo") === "detalle"
    );

    mostrarPlatillos(tortas, packs, bocaditos, detalles, platillosArreglo);
};

const mostrarPlatillos = (tortas, packs, bocaditos, detalles, todos) => {
    btnTorta.addEventListener("click", () => {
        limpiarHtml(contenedorPlatillos);
        tortas.forEach((torta) => contenedorPlatillos.appendChild(torta));
    });

    btnPack.addEventListener("click", () => {
        limpiarHtml(contenedorPlatillos);
        packs.forEach((pack) => contenedorPlatillos.appendChild(pack));
    });

    btnBocadito.addEventListener("click", () => {
        limpiarHtml(contenedorPlatillos);
        bocaditos.forEach((bocadito) =>
            contenedorPlatillos.appendChild(bocadito)
        );
    });
    btnDetalles.addEventListener("click", () => {
        limpiarHtml(contenedorPlatillos);
        detalles.forEach((detalle) => contenedorPlatillos.appendChild(detalle));
    });
    btnTodos.addEventListener("click", () => {
        limpiarHtml(contenedorPlatillos);
        todos.forEach((todo) => contenedorPlatillos.appendChild(todo));
    });
};

const limpiarHtml = (contenedor) => {
    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
};

// Primero SE selecciona todos los botones
const botones = document.querySelectorAll(".botones-platillos button");

// Luego SE agrega un evento de clic a cada botón
botones.forEach((boton) => {
    boton.addEventListener("click", (e) => {
        // Al hacer clic, primero elimina la clase 'activ' de todos los botones
        botones.forEach((btn) => {
            btn.classList.remove("activ");
        });
        // Luego, agrega la clase 'activ' al botón que fue presionado
        e.currentTarget.classList.add("activ");
    });
});
document.addEventListener("DOMContentLoaded", () => {
    const btnTodos = document.querySelector(".todos");
    btnTodos.classList.add("activ");
    eventos();
    platillos();
});

// BARRRAAAAAAAA DE busqueda

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const platillos = document.querySelectorAll(".platillo");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        platillos.forEach(function (platillo) {
            const nombreProducto = platillo
                .querySelector("h3")
                .textContent.toLowerCase();

            if (nombreProducto.includes(searchTerm)) {
                platillo.style.display = "block";
            } else {
                platillo.style.display = "none";
            }
        });
    });
});

/*=========================================
    MENU movil, ´para q se vea responsivo
==========================================*/
const headerMenu = document.querySelector(".hm-header");
console.log(headerMenu.offsetTop);
window.addEventListener("scroll", () => {
    if (window.pageYOffset > 80) {
        headerMenu.classList.add("header-fixed");
    } else {
        headerMenu.classList.remove("header-fixed");
    }
});

const menu = document.querySelector(".icon-menu");
const menuClose = document.querySelector(".cerrar-menu");

menu.addEventListener("click", () => {
    document.querySelector(".header-menu-movil").classList.add("active");
});

menuClose.addEventListener("click", () => {
    document.querySelector(".header-menu-movil").classList.remove("active");
});

// PARA EL CARRUSELLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
let carrusel = document.querySelector(".carrusel .list");
let items = document.querySelectorAll(".carrusel .list .item");
let next = document.getElementById("next");
let prev = document.getElementById("prev");
let dots = document.querySelectorAll(".carrusel .dots li");

let lengthItems = items.length - 1;
let active = 0;
next.onclick = function () {
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadCarrusel();
};
prev.onclick = function () {
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadCarrusel();
};
let refreshInterval = setInterval(() => {
    next.click();
}, 3000);
function reloadCarrusel() {
    carrusel.style.left = -items[active].offsetLeft + "px";
    //
    let last_active_dot = document.querySelector(".carrusel .dots li.active");
    last_active_dot.classList.remove("active");
    dots[active].classList.add("active");

    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 3000);
}

dots.forEach((li, key) => {
    li.addEventListener("click", () => {
        active = key;
        reloadCarrusel();
    });
});
window.onresize = function (event) {
    reloadCarrusel();
};
