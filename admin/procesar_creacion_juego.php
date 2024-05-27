<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos
    require_once '../conexion.php';

    // Obtener los datos del formulario
    $nombre_juego = $_POST['nombre_juego'];
    $descripcion_juego = $_POST['descripcion_juego'];
    $url_juego = $_POST['url_juego'];
    $edad_juego = $_POST['edad_juego'];
    $categoria_juego = $_POST['categoria_juego'];
    $id_usuario = $_POST['id_usuario'];

    // Procesar la imagen del juego
    $imagen_juego = $_FILES['imagen_juego']['tmp_name'];
    $imagen_juego_nombre = $_FILES['imagen_juego']['name'];
    $imagen_juego_tipo = $_FILES['imagen_juego']['type'];
    $imagen_juego_tamano = $_FILES['imagen_juego']['size'];

    // Procesar el archivo comprimido del juego
    $archivo_juego = $_FILES['archivo_juego']['tmp_name'];
    $archivo_juego_nombre = $_FILES['archivo_juego']['name'];
    $archivo_juego_tipo = $_FILES['archivo_juego']['type'];
    $archivo_juego_tamano = $_FILES['archivo_juego']['size'];

    // Verificar si se ha subido una imagen y un archivo
    if (isset($imagen_juego) && isset($archivo_juego)) {
        // Leer el contenido del archivo de la imagen y el archivo comprimido
        $imagen_juego_contenido = file_get_contents($imagen_juego);
        $archivo_juego_contenido = file_get_contents($archivo_juego);

        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        $conn = $conexion->obtenerConexion();

        // Preparar la consulta SQL para insertar el nuevo juego
        $sql = "INSERT INTO juegos (nombre_juego, imagen_juego, Descripcion, url_juego, edad, id_categoria, id_usuario, archivo_comprimido, estado_revision, fecha_creacion)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'En revisión', NOW())";
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("sbssiiis", $nombre_juego, $imagen_juego_contenido, $descripcion_juego, $url_juego, $edad_juego, $categoria_juego, $id_usuario, $archivo_juego_contenido);
        $stmt->execute();

        // Verificar si se ha insertado correctamente el nuevo juego
        if ($stmt->affected_rows > 0) {
            //echo "¡El juego se ha creado correctamente!";
            header("Location: revision.php");
        } else {
            echo "Error al crear el juego. Por favor, inténtalo de nuevo.";
        }

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $conexion->cerrarConexion();
    } else {
        echo "Por favor, selecciona una imagen y un archivo comprimido.";
    }
} else {
    // Si no se ha enviado el formulario, redireccionar a la página de inicio
    header("Location: index.php");
    exit();
}
?>
