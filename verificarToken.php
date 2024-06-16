<?php
error_reporting(0);
require 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = $_POST['token'];

    // Conectar a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    // Verificar si el correo electrónico y el token son válidos
    $sql = "SELECT id_usuario, fecha_expiracion_token FROM usuarios WHERE gmail = ? AND token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $expiry_date = $row['fecha_expiracion_token'];
        $current_date = date('Y-m-d H:i:s');

        if ($current_date <= $expiry_date) {
            // Token es válido
            $token_valido = true;
        } else {
            // Token ha expirado
            $token_valido = false;
            $error_message = "El token ha expirado.";
        }
    } else {
        // Token o correo electrónico no válidos
        $token_valido = false;
        $error_message = "El token introducido no es válido .";
    }

    // Cerrar la conexión
    $conexion->cerrarConexion();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi restablecer Contraseña</title>
    <link rel="icon" type="image/png" href="img/l7.png">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/Login/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
</head>
<style>
    body{
        display: grid;
        place-content: center;
    }
</style>
<body>
    <main>
        <div class="container">
            <div class="row">
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block lo2">
                    
                </section>
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 lo">
                    <div class="regisrto">
                        <div class="formulario">
                            <img class="formulario--logo" src="img/l7.png" alt="logo">
                            <h1 class="fromulario--titulo t">Restablecer su Contraseña</h1>
                            <?php
                            if (isset($token_valido) && $token_valido) {
                                echo '<p class="ingrese">Coloque su nueva contraseña a continuación.</p>';
                                echo '<div class="formulario--formulario">';
                                echo '<form action="restablecerContrasena.php" method="post">';
                                echo '<input type="hidden" name="email" value="' . $email . '">';
                                echo '<div class="formulario--formulario__campos">';
                                echo '<label for="password">Nueva Contraseña:</label>';
                                echo '<div class="input-group">';
                                echo '<input type="password" class="form-control" placeholder="Introduce su nueva contraseña" aria-label="Contraseña" aria-describedby="togglePassword" name="password" id="password" required>';
                                echo '<button class="btn btn-outline-secondary" type="button" id="togglePassword" name="password">';
                                echo '<i class="far fa-eye"></i>';
                                echo '</button>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="container">';
                                echo '<div class="formulario--formulario--botones row ">';
                                echo '<button type="submit" class="btn btn-naranja col-7">Guardar Contraseña</button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                            } elseif (isset($token_valido) && !$token_valido) {
                                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>
                                <button style="border:#f3873f solid 2px;" class="btn btn-naranja mt-3" onclick="goBack()">Volver</button>
                                ';
                                
                            }
                            ?>
                            <div class="uso" >
                                <p>Al unirme a Yatiñi, confirmo que he leído y acepto los
                                    <a href="#">Términos de servicio</a> y <a href="#"> la Política de privacidad</a> de
                                    Yatiñi y que recibo correos electrónicos y actualizaciones.</p>
                            </div>
                            <div class="invitado">
                                <p><a href="user/usuario.php">Ingresar como invitado</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script src="js/bootrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                // Cambiar el tipo de entrada de contraseña
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // Cambiar el icono del ojo
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
     <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
