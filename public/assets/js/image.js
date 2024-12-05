function previewImage(event) {
    const file = event.target.files[0]; // Obtiene el archivo seleccionado
    if (file) {
        const reader = new FileReader(); // Crea un lector de archivos
        reader.onload = function (e) {
            const imgPreview = document.getElementById("imgpreview"); // Div que contiene la imagen
            const preview = document.getElementById("preview"); // Elemento img para la previsualización
            preview.src = e.target.result; // Asigna la URL de la imagen al src
            imgPreview.style.display = "block"; // Muestra el contenedor de la imagen
        };
        reader.readAsDataURL(file); // Lee el archivo como una URL de datos
    }
}
