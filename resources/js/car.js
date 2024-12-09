document.addEventListener("DOMContentLoaded", function () {
    const btnCart = document.querySelector(".container-cart-icon");
    const slideOverCart = document.getElementById("cart-slide-over");
    const closeCart = document.getElementById("close-cart");
    const cartProducts = document.getElementById("cart-products");
    const cartTotal = document.getElementById("cart-total");
    const countProducts = document.getElementById("contador-productos");

    // Mostrar y cerrar el carrito flotante
    btnCart.addEventListener("click", () => {
        slideOverCart.classList.remove("hidden");
        document.body.classList.add("cart-open");
        fetchCart(); // Actualiza el contenido del carrito flotante
    });

    closeCart.addEventListener("click", () => {
        slideOverCart.classList.add("hidden");
        document.body.classList.remove("cart-open");
    });

    // Función para obtener el carrito desde el servidor
    function fetchCart() {
        fetch("/carrito/detalles")
            .then((response) => response.json())
            .then((data) => {
                renderCart(data.carrito, data.total, data.totalProductos); // Pasa el total de productos al renderizar
            });
    }

    // Renderizar el carrito
    function renderCart(carrito, total, totalProductos) {
        cartProducts.innerHTML = ""; // Limpia el contenido del carrito

        if (Object.keys(carrito).length === 0) {
            cartProducts.innerHTML = `<p class="text-center text-gray-500">El carrito está vacío</p>`;
            countProducts.textContent = 0; // Si está vacío, el contador debe ser 0
        } else {
            Object.values(carrito).forEach((product) => {
                const subtotal = product.precio * product.cantidad;

                const li = document.createElement("li");
                li.classList.add("flex", "py-4", "gap-3");
                li.innerHTML = ` 
                    <div class="overflow-hidden rounded-md border border-gray-200">
                        <img src="/imagenes/productos/${product.imagen}" alt="${
                    product.nombre
                }" style="height: 75px; width: 75px; object-fit: cover;">
                    </div>
                    <div class="flex-1">
    <div class="flex justify-between items-center font-medium text-gray-900 flex-wrap">
    <!-- Nombre del producto -->
    <h3 class="w-full sm:w-auto text-2xl sm:text-xl font-semibold text-gray-900 mb-2 sm:mb-0">
        ${product.nombre}
    </h3>

    <!-- Precio -->
    <p class="text-xl font-bold text-gray-800">
        S/. ${subtotal.toFixed(2)}
    </p>
</div>

    <div class="flex items-center justify-between mt-3">
        <div class="quantity-selector flex items-center gap-1">
            <!-- Botón Disminuir -->
            <button class="decrease-quantity bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-full w-8 h-8 flex items-center justify-center transition duration-200 ease-in-out" id="decrement-{{ $id }}">
                -
            </button>

            <!-- Input de cantidad -->
            <input 
                type="text" 
                class="quantity-input text-center border-2 border-gray-300 rounded-lg w-12 h-8 text-lg font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                name="cantidad" 
                value="${product.cantidad}" 
                readonly
            />

            <!-- Botón Incrementar -->
            <button class="increase-quantity bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-full w-8 h-8 flex items-center justify-center transition duration-200 ease-in-out" id="increment-{{ $id }}">
                +
            </button>
        </div>
        <button class="remove-product text-red-600 hover:text-red-800 transition duration-200" data-id="${
            product.id
        }">
            <i class="bi bi-trash3-fill"></i>
        </button>
    </div>
</div>

                `;
                cartProducts.appendChild(li);
            });

            cartTotal.textContent = `S/. ${total.toFixed(2)}`;
            countProducts.textContent = totalProductos; // Actualiza el contador con el total de productos
        }

        // Actualizar cantidad y eliminar productos
        document.querySelectorAll(".decrease-quantity").forEach((button) => {
            button.addEventListener("click", (e) => {
                const productId = e.target.dataset.id;
                const currentQuantity = e.target
                    .closest("li")
                    .querySelector("span").textContent;
                updateQuantity(productId, parseInt(currentQuantity) - 1); // Disminuir cantidad
            });
        });

        document.querySelectorAll(".increase-quantity").forEach((button) => {
            button.addEventListener("click", (e) => {
                const productId = e.target.dataset.id;
                const currentQuantity = e.target
                    .closest("li")
                    .querySelector("span").textContent;
                updateQuantity(productId, parseInt(currentQuantity) + 1); // Aumentar cantidad
            });
        });

        document.querySelectorAll(".remove-product").forEach((button) => {
            button.addEventListener("click", (e) => {
                const productId = e.target.dataset.id;
                removeProduct(productId);
            });
        });
    }

    // Agregar producto al carrito
    document.querySelectorAll(".btn-add-to-cart").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            const productId = button.dataset.productId;
            const quantity =
                button.closest("form").querySelector('input[name="quantity"]')
                    .value || 1;

            fetch("/carrito/agregar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ id: productId, quantity: quantity }),
            })
                .then((response) => response.json())
                .then(() => fetchCart()); // Actualiza el carrito flotante después de agregar el producto
        });
    });

    // Eliminar producto del carrito
    function removeProduct(productId) {
        fetch(`/carrito/quitar`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ id: productId }),
        })
            .then((response) => response.json())
            .then(() => fetchCart()); // Actualiza el carrito flotante después de eliminar el producto
    }

    // Actualizar cantidad de productos en el carrito
    function updateQuantity(productId, newQuantity) {
        if (newQuantity < 1) return; // Evitar que la cantidad sea menor a 1

        fetch(`/carrito/actualizar`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ id: productId, cantidad: newQuantity }),
        })
            .then((response) => response.json())
            .then(() => fetchCart()); // Actualiza el carrito flotante después de cambiar la cantidad
    }

    // Cargar el carrito flotante al iniciar
    fetchCart();
});
