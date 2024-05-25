<?php
require_once '../conexion.php'; // Asegúrate de que este archivo tenga la lógica de conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];

    // Validar y sanitizar los datos (te recomiendo utilizar funciones como filter_var o mysqli_real_escape_string)

    // Actualizar los datos en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $stmt = $conn->prepare("UPDATE categoria SET nombre_categoria = ? WHERE id_categoria = ?");
    $stmt->bind_param("si", $nombre_categoria, $id_categoria);
    $stmt->execute();

    // Verificar si la actualización fue exitosa
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
