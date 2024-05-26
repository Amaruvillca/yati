
<?php
require_once '../conexion.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_juego = $_GET['id'];

    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    $stmt = $conn->prepare("SELECT nombre_juego, archivo_comprimido FROM juegos WHERE id_juego = ?");
    $stmt->bind_param("i", $id_juego);
    $stmt->execute();
    $stmt->bind_result($nombre_juego, $archivo_comprimido);
    $stmt->fetch();
    $stmt->close();

    // Generar el nombre del archivo comprimido
    $nombre_archivo = $nombre_juego . ".zip";

    // Establecer encabezados para la descarga
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=\"$nombre_archivo\"");
    header("Content-Length: " . strlen($archivo_comprimido));

    // Enviar el archivo comprimido al navegador para su descarga
    echo $archivo_comprimido;
    exit;
} else {
    // Si el ID del juego no está presente o es inválido, redirigir a la página de juegos
    header("Location: juegos.php");
    exit;
}
?>
