<?php
session_start();
$gmail = $_POST['email'];
$contrasena = $_POST['password'];

require_once 'conexion.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi ingreso</title>
    <link rel="icon" type="image/png" href="img/l7.png">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/Login/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <section  class="col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block lo2">
                    
                </section>
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 lo">
                    <div class="regisrto">
                        <div class="formulario">
                            <img class="formulario--logo" src="img/l7.png" alt="logo">
                            <h1 class="fromulario--titulo">Acceso</h1>
                            <div class="formulario--formulario">
                                <form action="#" method="post">

                                    

                                    <div class="formulario--formulario__campos">
                                        <label for="email">Correo Electrónico:</label>
                                        <input type="email" class="form-control" placeholder="Introdusca su cotrreo electronico"
                                            aria-label="Username" aria-describedby="basic-addon1" name="email"
                                            id="email" value="<?php  echo $gmail ?>" required>
                                    </div>

                                    <div class="formulario--formulario__campos">
                                        <label for="password">contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Introduce tu contraseña"
                                                aria-label="Contraseña" aria-describedby="togglePassword" name="password" id="password" value="<?php  echo $contrasena ?>" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" name="password">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="formulario--formulario__yaeresusuario_contraseña">
                                        <p><a href="recuperarContra.php">¿Olvidaste tu contraseña?</a></p>
                                        <p>¿No eres usuario?<span><a href="index.php"> Crear</a></span> </p>
                                    </div>
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                       
                                    
                                        // Instanciar la clase Conexion
                                        $conexion = new Conexion();
                                        // Obtener la conexión
                                        $conn = $conexion->obtenerConexion();
                                    
                                        // Consulta para verificar si el correo electrónico está registrado
                                        $stmt = $conn->prepare("SELECT id_usuario, tipo, contrasena FROM usuarios WHERE gmail = ?");
                                        $stmt->bind_param("s", $gmail);
                                        $stmt->execute();
                                        $stmt->store_result();
                                    
                                        if ($stmt->num_rows > 0) {
                                            // El correo electrónico está registrado, comprobar la contraseña
                                            $stmt->bind_result($id_usuario, $tipo, $contrasena_bd);
                                            $stmt->fetch();
                                    
                                            if ($contrasena == $contrasena_bd) {
                                                // Contraseña correcta, iniciar sesión
                                                $_SESSION['id_usuario'] = $id_usuario;
                                                $_SESSION['tipo'] = $tipo;
                                    
                                                if ($tipo == 'administrador') {
                                                    header("Location: admin.php");
                                                } elseif ($tipo == 'usuario') {
                                                    header("Location: usuario.php");
                                                }
                                            } else {
                                                // Contraseña incorrecta
                                                echo '<div id="etiqueta" class="alert alert-danger" role="alert">
                                                    Contraseña incorrecta. Por favor, inténtalo de nuevo.
                                                </div>';
                                            }
                                        } else {
                                            // Correo electrónico no registrado
                                            echo '<div id="etiqueta" class="alert alert-danger" role="alert">
                                                Correo electrónico no registrado.
                                            </div>';
                                        }
                                    
                                        // Cerrar la conexión
                                        $stmt->close();
                                        $conexion->cerrarConexion();}
                                ?>
                                    <div class="container">
                                        <div class="formulario--formulario--botones row ">
                                            <button type="submit" class="btn btn-naranja col-5">Iniciar</button>
                                            <p class="col-2 centrar">o</p>
                                            <a href="#" class="btn-google col-5">
                                                <i class="fab fa-google icon-google"></i> Google
                                            </a>

                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="uso">
                                <p>Al unirme a Yatiñi, confirmo que he leído y acepto los
                                     <a href="#">Términos de servicio</a> y <a href="#"> la Política de
                                        privacidad </a>de
                                    Yatiñi y que recibo correos electrónicos y actualizaciones.</p>
                            </div>
                            <div class="invitado">
                                <p><a href="#">Ingresar como invitado</a></p>
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
    
</body>

</html>