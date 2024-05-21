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