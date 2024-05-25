<?php
require_once '../conexion.php'; // Asegúrate de que este archivo tenga la lógica de conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_categoria = $_POST['nombre_categoria'];

    // Validar y sanitizar los datos (te recomiendo utilizar funciones como filter_var o mysqli_real_escape_string)

    // Insertar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $stmt = $conn->prepare("INSERT INTO categoria (nombre_categoria) VALUES (?)");
    $stmt->bind_param("s", $nombre_categoria);
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
?>
