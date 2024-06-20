<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos
    require_once '../conexion.php';

    // Obtener los datos del formulario
    $nombre_juego = $_POST['nombre_juego'];
    $descripcion_juego = $_POST['descripcion_juego'];
    $url_juego = "hola";
    $edad_juego = $_POST['edad_juego'];
    $categoria_juego = $_POST['categoria_juego'];
    $id_usuario = $_POST['id_usuario'];

    // Procesar la imagen del juego
    if (isset($_FILES['imagen_juego']) && $_FILES['imagen_juego']['error'] == UPLOAD_ERR_OK) {
        $imagen_juego = file_get_contents($_FILES['imagen_juego']['tmp_name']);
    } else {
        $imagen_juego = null;
    }

    // Procesar el archivo comprimido del juego
    if (isset($_FILES['archivo_juego']) && $_FILES['archivo_juego']['error'] == UPLOAD_ERR_OK) {
        $archivo_juego = file_get_contents($_FILES['archivo_juego']['tmp_name']);
    } else {
        $archivo_juego = null;
    }

    // Crear una instancia de la clase Conexion
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    // Preparar la consulta SQL para insertar el nuevo juego
    $sql = "INSERT INTO juegos (nombre_juego, imagen_juego, Descripcion, url_juego, edad, id_categoria, id_usuario, archivo_comprimido, estado_revision, fecha_creacion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'En revisión', NOW())";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros y ejecutar la consulta
    $stmt->bind_param("sbssiiis", $nombre_juego, $imagen_juego, $descripcion_juego, $url_juego, $edad_juego, $categoria_juego, $id_usuario, $archivo_juego);
    $stmt->send_long_data(1, $imagen_juego); // Enviar los datos binarios de la imagen
    $stmt->send_long_data(7, $archivo_juego); // Enviar los datos binarios del archivo comprimido

    if ($stmt->execute()) {
        // Redireccionar a la página de revisión
        header("Location: revision.php");
    } else {
        echo "Error al crear el juego. Por favor, inténtalo de nuevo.";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->cerrarConexion();
} else {
    // Si no se ha enviado el formulario, redireccionar a la página de inicio
    header("Location: index.php");
    exit();
}
?>
