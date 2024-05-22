document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Cambiar el tipo de entrada de contraseña
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Cambiar el icono del ojo
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    document.querySelector('#registroForm').addEventListener('submit', function (e) {
        const nombre = document.querySelector('#nombre');
        const email = document.querySelector('#email');
        const password = document.querySelector('#password');

        const nombreError = document.querySelector('#nombreError');
        const emailError = document.querySelector('#emailError');
        const passwordError = document.querySelector('#passwordError');

        const emailRegex = /\S+@\S+\.\S+/;
        const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

        let valid = true;

        if (nombre.value.length <= 5) {
            nombreError.style.display = 'block';
            nombre.classList.add('is-invalid');
            valid = false;
        } else {
            nombreError.style.display = 'none';
            nombre.classList.remove('is-invalid');
        }

        if (!emailRegex.test(email.value)) {
            emailError.style.display = 'block';
            email.classList.add('is-invalid');
            valid = false;
        } else {
            emailError.style.display = 'none';
            email.classList.remove('is-invalid');
        }

        if (!passwordRegex.test(password.value)) {
            passwordError.style.display = 'block';
            password.classList.add('is-invalid');
            valid = false;
        } else {
            passwordError.style.display = 'none';
            password.classList.remove('is-invalid');
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});

// Función para ocultar los mensajes de alerta después de un cierto tiempo
function ocultarMensajes() {
    // Selecciona todos los elementos con la clase "alert" y recórrelos
    var mensajes = document.querySelectorAll('.alert');
    mensajes.forEach(function(mensaje) {
        // Oculta cada mensaje después de 4 segundos
        setTimeout(function() {
            mensaje.style.display = 'none';
        }, 5000); // 4000 milisegundos = 4 segundos
    });
}

// Llama a la función para ocultar los mensajes cuando el documento esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    ocultarMensajes();
});
function openGoogleAuthPopup() {
    // URL de autenticación de Google
    var authUrl = 'https://accounts.google.com/o/oauth2/auth?client_id=TU_CLIENT_ID&redirect_uri=URL_DE_REDIRECCION&response_type=code&scope=email%20profile';
    
    // Configura el tamaño y otras propiedades de la ventana emergente
    var width = 600;
    var height = 600;
    var left = (screen.width - width) / 2;
    var top = (screen.height - height) / 2;
    var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;
  
    // Abre la ventana emergente
    var authWindow = window.open(authUrl, 'googleAuthWindow', options);
  
    // Maneja el cierre de la ventana emergente (opcional)
    var timer = setInterval(function() {
      if (authWindow.closed) {
        clearInterval(timer);
        // Aquí puedes realizar acciones adicionales si la ventana emergente se cierra
      }
    }, 1000);
  }