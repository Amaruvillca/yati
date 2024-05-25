<?php
require_once '../conexion.php'; // Asegúrate de que este archivo tenga la lógica de conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['gmail'];
    $contrasena = $_POST['contrasena'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    // Validar y sanitizar los datos (te recomiendo utilizar funciones como filter_var o mysqli_real_escape_string)

    // Insertar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, gmail, contrasena, tipo, estado) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $email, $contrasena, $tipo, $estado);
    $stmt->execute();

    // Verificar si la inserción fue exitosa
    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();
}
