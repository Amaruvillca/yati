<?php
// Verificar si se proporciona un ID de juego válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_juego = $_GET['id'];

    // Conexión a la base de datos
    require_once '../conexion.php';
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    // Consulta para obtener la información del juego
    $stmt = $conn->prepare("SELECT archivo_comprimido, nombre_juego FROM juegos WHERE id_juego = ?");
    $stmt->bind_param("i", $id_juego);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró el juego
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($archivo_comprimido, $nombre_juego);
        $stmt->fetch();

        // Establecer las cabeceras para la descarga del archivo
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nombre_juego . '.rar"');

        // Enviar el archivo al cliente
        echo $archivo_comprimido;
    } else {
        echo "Archivo no encontrado";
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();
} else {
    echo "ID de juego no válido";
}
?>
