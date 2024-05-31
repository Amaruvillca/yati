<?php
error_reporting(0);
session_start();

if (isset($_COOKIE['id_usuario']) && isset($_COOKIE['tipo']) && $_COOKIE['tipo'] == 'usuario') {
    $_SESSION[ $_COOKIE['id_usuario']] = $_COOKIE['id_usuario'];
    $_SESSION['tipo'] = $_COOKIE['tipo'];
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redireccionando...</title>
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
        <style>
            
            #loadingOverlay {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1000;
            }
            .spinner-border {
                width: 3rem;
                height: 3rem;
                border-width: .3rem;
            }
            
           
        </style>
    </head>
    <body>
    
        <div id="loadingOverlay">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "user/usuario.php";
            }, 2000); // 3 segundos
        </script>
    </body>
    </html>';
   
}
?>
<?php
require 'Conexion.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi Login</title>
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
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 lo">
                    <div class="regisrto">
                        <div class="formulario">
                            <img class="formulario--logo" src="img/l7.png" alt="logo">
                            <h2 class="fromulario--titulo">Unete a Yatiñi</h2>
                            <div class="formulario--formulario">
                                <form id="registroForm" action="index.php" method="post">
                                    <div class="formulario--formulario__campos">
                                        <label for="nombre">Nombre de Usuario:</label>
                                        <input type="text" class="form-control" placeholder="Ejemplo: alva2000" aria-label="Username" aria-describedby="basic-addon1" name="nombre" id="nombre" value="<?php  echo $nombre?>" required>

                                        <div id="nombreError" class="error">El nombre de usuario debe tener más de 5 caracteres.</div>
                                    </div>
                                    <div class="formulario--formulario__campos">
                                        <label for="email">Correo Electrónico:</label>
                                        <input type="email" class="form-control" placeholder="afsfsdsd@gmail.com" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email" value="<?php  echo $email ?>" required>
                                        <div id="emailError" class="error">El correo electrónico debe contener un '@' o un .</div>
                                    </div>
                                    <div class="formulario--formulario__campos">
                                        <label for="password">Contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Introduce tu contraseña" aria-label="Contraseña" aria-describedby="togglePassword" name="password" id="password" value="<?php  echo $password ?>" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" name="password">
                                                <i class="far fa-eye"> </i>
                                            </button>
                                        </div>
                                        <div id="passwordError" class="error">La contraseña debe tener al menos 8 caracteres, incluyendo números, letras mayúsculas y minúsculas.</div>
                                    </div>
                                    <div class="formulario--formulario__yaeresusuario">
                                        <p>¿Ya eres usuario?<span><a href="ingreso.php"> Acceso</a></span> </p>
                                    </div>
                                    <?php
                                    // Obtener los datos del formulario
                                    
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        
                                        

                                        // Crear una instancia de la clase de conexión
                                        $conexion = new Conexion();

                                        // Obtener la conexión
                                        $conn = $conexion->obtenerConexion();

                                        // Verificar si el nombre de usuario ya está registrado
                                        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre'";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // El nombre de usuario ya está en uso
                                            // echo "<script>alert('El nombre de usuario ya está en uso.')</script>";
                                            echo '<div class="alert alert-danger" role="alert">
                                        El nombre de usuario ya está en uso.
                                        </div>';
                                        } else {
                                            // Verificar si el correo electrónico ya está registrado
                                            $sql = "SELECT * FROM usuarios WHERE gmail = '$email'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                // El correo electrónico ya tiene una cuenta asociada
                                                //echo "<script>alert('El correo electrónico ya tiene una cuenta asociada.')</script>";
                                                echo '<div id="etiqueta" class="alert alert-danger" role="alert">
                                            El correo electrónico ya tiene una cuenta asociada.
                                        </div>';
                                            } else {
                                                // Insertar el nuevo usuario en la base de datos
                                                $sql = "INSERT INTO usuarios (nombre_usuario, gmail, contrasena, tipo) VALUES ('$nombre', '$email', '$password', 'usuario')";
                                                if ($conn->query($sql) === TRUE) {
                                                    // Usuario registrado con éxito
                                                    //echo "<script>alert('Usuario registrado con éxito. Redireccionando a ingreso.php...')</script>";
                                                    
                                                    echo '<div id="etiqueta" class="alert alert-success" role="alert">
                                                   Usuario registrado con éxito. Redireccionando a ingreso
                                                 </div>';
                                                echo "<script>setTimeout(function() { window.location.href = 'ingreso.php'; }, 3000);</script>";
                                                } else {
                                                    // Error al registrar el usuario
                                                    //echo "<script>alert('Error al registrar el usuario: " . $conn->error . "')</script>";
                                                    echo '<div id="etiqueta" class="alert alert-danger" role="alert">
                                                    Error al registrar el usuario:'. $conn->error.'
                                        </div>';
                                                }
                                            }
                                        }

                                        // Cerrar la conexión
                                        $conexion->cerrarConexion();
                                    }
                                    
                                    ?>

                                    <div class="container">
                                        <div class="formulario--formulario--botones row">
                                            <button type="submit" class="btn btn-naranja col-5">Registrar</button>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <p class="centrar">o</p>
                                            </div>
                                            <a href="#" class="btn-google col-5" onclick="openGoogleAuthPopup(); return false;">
                                                <i class="fab fa-google icon-google" ></i> Google
                                            </a>
   
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="uso">
                                <p>Al unirme a Yatiñi, confirmo que he leído y acepto los
                                    <a href="#">Términos de servicio</a> y <a href="#">la Política de
                                        privacidad</a> de
                                    Yatiñi y que recibo correos electrónicos y actualizaciones.
                                </p>
                            </div>
                            <div class="invitado">
                                <p><a href="user/usuario.php">Ingresar como invitado</a></p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block lo2">
                    
                        
                                                    
                </section>
            </div>
        </div>
    </main>

    <script src="js/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    
  
</body>

</html>
