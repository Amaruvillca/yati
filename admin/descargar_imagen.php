<?php
require_once '../conexion.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_juego = $_GET['id'];

    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $stmt = $conn->prepare("SELECT nombre_juego, imagen_juego FROM juegos WHERE id_juego = ?");
    $stmt->bind_param("i", $id_juego);
    $stmt->execute();
    $stmt->bind_result($nombre_juego, $imagen_juego);
    $stmt->fetch();
    $stmt->close();

    // Establecer encabezados para la descarga
    header("Content-Type: image/jpeg");
    header("Content-Disposition: attachment; filename=\"$nombre_juego.jpg\"");
    header("Content-Length: " . strlen($imagen_juego));

    // Enviar la imagen al navegador para su descarga
    echo base64_decode($imagen_juego);
    exit;
} else {
    // Si el ID del juego no está presente o es inválido, redirigir a la página de juegos
    header("Location: juegos.php");
    exit;
}
?>
