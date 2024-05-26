<?php
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $id_juego = $_POST['id_juego'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $url = $_POST['url'];
    $estado_revision = $_POST['estado_revision'];

    $stmt = $conn->prepare("UPDATE juegos SET nombre_juego = ?, Descripcion = ?, id_categoria = ?, url_juego = ?, estado_revision = ? WHERE id_juego = ?");
    $stmt->bind_param("ssissi", $nombre, $descripcion, $categoria, $url, $estado_revision, $id_juego);

    if ($stmt->execute()) {
        header("Location: ver_juego.php?id=$id_juego");
    } else {
        echo "Error al actualizar el juego: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
