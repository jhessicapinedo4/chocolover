@extends('layouts.header')

@section('content')

    <section id="contacto"  style="
        display: flex; 
        justify-content: center; 
        align-items: center; 
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('imagenes/fondo.jpg') }}'); 
        background-position: center center; 
        background-size: cover; 
        background-repeat: no-repeat;">
        <div class="contenido">
            <div class="box-info">
                <h1>CONTACTANOS AHORA</h1>
                <div class="data">
                    <p><i class="bi bi-telephone"></i>+51 951114454</p>
                    <p><i class="bi bi-envelope"></i>chocolover@gmail.com</p>
                    <p><i class="bi bi-geo-alt"></i>Av. PIZARRO 666</p>
                </div>
                <div class="links">
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"> </i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <form class="formulario">
                <div class="input-box">
                    <input type="text" required placeholder="Nombre y Apellido" /><i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" required placeholder="Correo electronico" /><i class="fa-solid fa-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Asunto" /><i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div class="input-box">
                    <textarea cols="30" rows="10" type="text" required placeholder="Escriba su mensaje"></textarea>
                </div>
                <button class="buton" type="submit">Enviar mensaje</button>
            </form>
        </div>
    </section>

    <div class="map">
        <h2 class="title-ubi">Ubicacion</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d246.85971502557607!2d-79.03580293570391!3d-8.126363218006768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad3dd1e4859bdd%3A0x2626ecdad6dc0ce7!2sChocolover%20Trujillo!5e0!3m2!1ses!2spe!4v1703890312535!5m2!1ses!2spe"
            width="800" height="400" style="border: 0" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="ubicacion"></iframe>
    </div>
@endsection
