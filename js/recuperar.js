function ocultarMensaje() {
    setTimeout(function() {
        var mensaje = document.querySelector('.alert'); // Selecciona el elemento con la clase 'alert'
        if (mensaje) {
            mensaje.style.display = 'none'; // Oculta el mensaje
        }
    }, 5000); // 5000 milisegundos = 5 segundos
}

// Llama a la función de ocultarMensaje cuando se cargue la página
window.addEventListener('load', ocultarMensaje);