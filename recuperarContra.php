<?php
error_reporting(0);
require 'Conexion.php';
$email = $_POST['email'];
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

<body>
    <main>
        <div class="container">
            <div class="row">
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block lo2">
                    p
                </section>
                <section class="col-lg-6 col-md-6 col-sm-12 col-12 lo">
                    <div class="regisrto">
                        <div class="formulario">
                            <img class="formulario--logo" src="img/l7.png" alt="logo">
                            <h1 class="fromulario--titulo t">Restablecer su Contraseña</h1>
                            <p class="ingrese">Ingrese su correo electrónico y le enviaremos
                                un enlace para restablecer su contraseña.</p>
                            <div class="formulario--formulario">
                                <form action="recuperarContra.php" method="post">



                                    <div class="formulario--formulario__campos">
                                        <label for="email">Correo Electrónico:</label>
                                        <input type="email" class="form-control" placeholder="Introdusca su cotrreo electronico" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email" value="<?php echo $email ?>" required>
                                    </div>



                                    <div class="formulario--formulario__yaeresusuario_contraseña">
                                        <p>¿Ya eres usuario?<span><a href="ingreso.php"> Acceso</a></span> </p>
                                        <p>¿No eres usuario?<span><a href="index.php"> Crear</a></span> </p>
                                    </div>
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        //$email = $_POST['email'];

                                        //Verificar si el correo electrónico está en la base de datos
                                        $conexion = new Conexion();
                                        $conn = $conexion->obtenerConexion();

                                        $sql = "SELECT id_usuario FROM usuarios WHERE gmail = '$email'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // El correo electrónico existe, generar y guardar el token
                                            $token = bin2hex(random_bytes(3)); // Generar token único
                                            $expiry_date = date('Y-m-d H:i:s', strtotime('+1 hour')); // Fecha de expiración del token

                                            // Guardar el token en la base de datos
                                            $sql = "UPDATE usuarios SET token = '$token', fecha_expiracion_token = '$expiry_date' WHERE gmail = '$email'";
                                            if ($conn->query($sql) === TRUE) {
                                                // Enviar correo electrónico con el token al usuario
                                                $to = $email;
                                                $subject = 'Restablecer contraseña - Yatiñi';
                                                $message = '
                                                <!DOCTYPE html>
                                                <html lang="es">
                                                <head>
                                                    <meta charset="UTF-8">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Restablecer contraseña</title>
                                                    <style>
                                                        .token {
                                                            font-size: 24px;
                                                            font-weight: bold;
                                                            margin-top: 20px;
                                                        }
                                                        .container {
                                                            text-align: center;
                                                        }
                                                        img{
                                                            width: 100px;}
                                                    </style>
                                                </head>
                                                <body>
                                                    <div class="container">
                                                    <img src="https://lh3.googleusercontent.com/ogw/AF2bZyhT_fcpE_Un89i9zQKIVxhy-DUlRkXkyzMM3_4C3XAsbQ=s32-c-mo" alt="Imagen centrada" />
                                                     <center><h1>Yatiñi</h1></center> <br>
                                                        <h3>Token de verificación:</h3>
                                                        
                                                        <p class="token">' . $token . '</p>
                                                        <p>copie el codigo y peguelo en la pagina web para restablecer su contraseña </p>
                                                    </div>
                                                </body>
                                                </html>
                                                ';
                                                $headers = "MIME-Version: 1.0" . "\r\n";
                                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                                $headers .= 'From: <yatini.educa2024@gmail.com>' . "\r\n";
                                                mail($to, $subject, $message, $headers);

                                                echo '<div class="alert alert-success" role="alert">
                                                        Se ha enviado un token de restablecimiento de contraseña a tu correo electrónico.
                                                    </div>';
                                                $estadoenviado = true;
                                    ?>


                                    <?php
                                            } else {
                                                echo '<div class="alert alert-danger" role="alert">
                                                        Error al generar el token. Por favor, inténtalo de nuevo más tarde.
                                                    </div>';
                                                $estadoenviado = false;
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger" role="alert">
                                                    El correo electrónico proporcionado no está registrado.
                                                </div>';
                                            $estadoenviado = false;
                                        }

                                        // Cerrar la conexión
                                        $conexion->cerrarConexion();
                                    }
                                    ?>
                                    <div class="container">
                                        <div class="formulario--formulario--botones row ">
                                            <button type="submit" class="btn btn-naranja col-5">Buscar</button>


                                        </div>
                                    </div>

                                </form>
                                <?php
                                if ($estadoenviado) {
                                    ?>
                                    <div class="formulario--formulario__campos">
                                                        <label for="token">Introduzca el Token:</label>
                                                        <form action="verificarToken.php" method="post">
                                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                                                            <input type="text" class="form-control" placeholder="Introduzca el token recibido"
                                                                aria-label="Token" aria-describedby="basic-addon1" name="token"
                                                                id="token" required>
                                                            <div class="container">
                                                                <p><a href="<?php mail($to, $subject, $message, $headers); ?>">Reenviar token</a></p>
                                                                <div class="formulario--formulario--botones row">
                                                                    <button type="submit" class="btn btn-naranja col-5">Verificar Token</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="uso">
                                <p>Al unirme a Yatiñi, confirmo que he leído y acepto los
                                     <a href="#">Términos de servicio</a> y <a href="#"> la Política de
                                        privacidad </a>de
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
    <script src="js/recuperar.js"></script>

</body>

</html>