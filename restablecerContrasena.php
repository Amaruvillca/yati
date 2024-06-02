<?php
require 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['password'];

    // Conectar a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    // Actualizar la contraseña y eliminar el token y su fecha de expiración
    $sql = "UPDATE usuarios SET contrasena = ?, token = NULL, fecha_expiracion_token = NULL WHERE gmail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password, $email);

    $response_message = "";
    if ($stmt->execute()) {
        $response_message = '<div class="alert alert-success" role="alert">Tu contraseña ha sido restablecida exitosamente. Serás redirigido a la página de ingreso en 2 segundos.</div>';
        header("refresh:3;url=ingreso.php");
    } else {
        $response_message = '<div class="alert alert-danger" role="alert">Hubo un error al restablecer tu contraseña. Por favor, inténtalo de nuevo más tarde.</div>';
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
    <title>Yatiñi - Restablecer Contraseña</title>
    <link rel="icon" type="image/png" href="img/l7.png">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/Login/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        body{
            background-color: white;
        }
        .formulario--titulo{
            font-size: xx-small;
        }
    </style>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                    <div class="registro mt-5">
                        <div class="formulario text-center">
                            <img class="formulario--logo mb-4" src="img/l7.png" alt="logo">
                            <h1 class="formulario--titulo t">Restablecer Contraseña</h1>
                            <?php
                            if (isset($response_message)) {
                                echo $response_message;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/bootrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
