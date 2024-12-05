<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CHOCOLOVER</title>
    <link rel="icon" href="/imagenes/corazon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @stack('css')

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header class="hm-header">
        <div class="container header-menu">
            <!-- LOGO -->
            <div class="hm-logo">
                <a href="/">
                    <img src="/imagenes/logo.png" alt="Logo Chocolover" />
                </a>
            </div>

            <!-- MENU DE NAVEGACIÓN -->
            <nav class="hm-menu">
                <ul class="menuu">
                    <li><a href="/" class="navigation__link">Inicio</a></li>
                    <li><a href="/catalogo" class="navigation__link">Productos</a></li>
                    <li><a href="/nosotros" class="navigation__link">Nosotros</a></li>
                    <li><a href="{{ route('recetas.indexCliente') }}" class="navigation__link">Recetas</a></li>
                </ul>
            </nav>

            <!-- ICONOS DE USUARIO Y CARRITO -->
            <div class="hm-icon-cart">
                <!-- Icono de usuario -->
                <a href="{{ Auth::check() && Auth::user()->role == 'cliente' ? route('cliente.dashboard') : route('cliente.login') }}"
                    class="icon-link">
                    <i class="bi bi-person-circle"></i>
                </a>




                <!-- Icono del carrito -->
                <div class="container-icon">
                    <div class="container-cart-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon-cart">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <div class="count-products">
                            <span id="contador-productos">0</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Icono del menú móvil -->
            <div class="icon-menu">
                <button type="button"><i class="bi bi-list"></i></button>
            </div>
        </div>

        <!-- MENÚ MÓVIL -->
        <div class="header-menu-movil">
            <button class="cerrar-menu"><i class="bi bi-backspace"></i></button>
            <ul class="menuu">
                <li><a href="/">Inicio</a></li>
                <li><a href="/catalogo">Productos</a></li>
                <li><a href="/nosotros">Nosotros</a></li>
                <li><a href="{{ route('recetas.indexCliente') }}">Recetas</a></li>
                <li><a href="{{ route('cliente.login') }}">Mi cuenta</a></li>
            </ul>
        </div>
    </header>

    <!-- CARRITO SLIDE-OVER -->

    <div class="relative z-[100] hidden" id="cart-slide-over" aria-labelledby="slide-over-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/10 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full">
                    <div class="pointer-events-auto w-full sm:w-[430px] max-w-[500px]">
                        <div class="flex flex-col bg-white shadow-xl h-full">
                            <!-- Título -->
                            <div class="flex-1 px-4 sm:px-6 py-6 relative">
                                <div class="flex items-center justify-center">
                                    <h2 class="text-3xl sm:text-5xl font-semibold text-gray-900" id="slide-over-title">
                                        Mi carrito</h2>
                                    <button type="button" id="close-cart"
                                        class="absolute top-0 -left-8 sm:-left-[26px] flex items-center text-gray-600 hover:text-gray-900">
                                        <div
                                            class="flex items-center justify-center bg-gray-100 text-gray-900 rounded-full w-12 h-12 sm:w-16 sm:h-16 hover:bg-red-600 hover:text-white">
                                            <svg class="h-6 w-6 sm:h-10 sm:w-10 transition-colors duration-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>

                                <!-- Productos -->
                                <div class="mt-8 cart-products-container overflow-y-auto max-h-[60vh]">
                                    <div class="flow-root">
                                        <ul id="cart-products" class="space-y-4">
                                            <!-- Productos renderizados dinámicamente -->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Total y botones -->
                            <div class="border-t border-gray-200 px-4 sm:px-6 py-6">
                                <div class="flex justify-between text-xl font-semibold text-gray-900">
                                    <p>Total parcial:</p>
                                    <p id="cart-total">S/ 0.00</p>
                                </div>
                                <div class="mt-6 flex flex-col gap-4">
                                    <a href="{{ route('carrito.mostrar') }}" class="w-full">
                                        <button
                                            class="w-full rounded-3xl bg-gray-300 px-4 sm:px-6 py-2 sm:py-3 text-lg sm:text-2xl font-medium text-white shadow-sm hover:bg-gray-500 transition-colors">
                                            Ver carrito
                                        </button>
                                    </a>

                                    <button
                                        class="boton w-full rounded-3xl px-4 sm:px-6 py-2 sm:py-3 text-lg sm:text-2xl">
                                        Finalizar compra
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div>



        @yield('content')




    </div>

    <footer class="footer">
        <div class="container container-footer">
            <div class="menu-footer">
                <div class="contact-info">
                    <p class="title-footer">Información de Contacto</p>
                    <ul>
                        <li>Dirección: Av. Húsares de Junín 1137, Trujillo 13008</li>
                        <li>Teléfono: +51 950 616 657</li>
                        <li>EmaiL: chocolover@gmail.com</li>
                    </ul>
                    <div class="social-icons">
                        <span class="facebook">
                            <a href="https://web.facebook.com/chocolovertrujillo?_rdc=1&_rdr">
                                <i class="bi bi-facebook"></i></a>
                        </span>

                        <span class="whattsap">
                            <a href="https://api.whatsapp.com/message/XP3V5OJFNPSRM1?autoload=1&app_absent=0">
                                <i class="bi bi-whatsapp"></i></a>
                        </span>
                        <span class="tiktok">
                            <a href="https://www.tiktok.com/@chocolover_trujillo">
                                <i class="bi bi-tiktok"></i></a>
                        </span>
                        <span class="instagram">
                            <a href="https://www.instagram.com/chocolover_trujillo?utm_source=ig_web_button_share_sheet&igsh=OGQ5ZDc2ODk2ZA=="
                                target="_blank"><i class="bi bi-instagram"></i></a>
                        </span>
                    </div>
                </div>

                <div class="information">
                    <p class="title-footer">Información</p>
                    <ul>
                        <li><a href="/nosotros">Acerca de Nosotros</a></li>
                        <li><a href="delivery.pdf" download="" target="_blank">Información Delivery</a></li>
                        <li><a href="/politicas">Politicas de Privacidad</a></li>
                        <li><a href="/terminos">Términos y condiciones</a></li>
                        <li><a href="/contacto">Contactános</a></li>
                    </ul>
                </div>

                <div class="my-account">

                  
                        <p class="title-footer">Mi cuenta</p>
                  


                    <ul>
                        <a href="{{ Auth::check() && Auth::user()->role == 'cliente' ? route('cliente.dashboard') : route('cliente.login') }}"
                            class="icon-link">
                            <li>Mi cuenta</li>
                        </a>
                        <li><a href="#">Historial de ordenes</a></li>
                        <li><a href="#">Reembolsos</a></li>
                    </ul>
                </div>

                <div class="newsletter">
                    <p class="title-footer">Boletín informativo</p>

                    <div class="content">
                        <p>
                            Suscríbete a nuestros boletines ahora y mantente al día con
                            nuevas colecciones y ofertas exclusivas.
                        </p>
                        <input type="email" placeholder="Ingresa el correo aquí..." />
                        <button>Suscríbete</button>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>Desarrollado por Chocolover &copy; 2024</p>
                <img src="/imagenes/pago.png" alt="Pagos" class="pagos" />
            </div>
        </div>
    </footer>

    <div class="whatsapp-button">
        <a href="https://api.whatsapp.com/message/XP3V5OJFNPSRM1?autoload=1&app_absent=0" target="_blank">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>


    @vite(['resources/js/funcional.js', 'resources/js/car.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('js')
</body>

</html>
