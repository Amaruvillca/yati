<?php
// Conexión a la base de datos
require_once '../conexion.php';
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

// Consulta para obtener los juegos aprobados
$stmt = $conn->prepare("SELECT * FROM juegos WHERE estado_revision = 'Aprobado'");
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay juegos y mostrarlos en la tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_juego'] . "</td>";
        echo "<td>" . $row['nombre_juego'] . "</td>";
        echo "<td>" . $row['Descripcion'] . "</td>";
        echo "<td><a href='" . $row['url_juego'] . "'>" . $row['url_juego'] . "</a></td>";
        echo "<td>" . $row['edad'] . "</td>";
        // Mostrar la categoría (si tienes una tabla de categorías relacionada)
        echo "<td>" . $row['id_categoria'] . "</td>";
        // Mostrar la imagen del juego
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagen_juego']) . "' alt='Imagen del juego' style='max-width: 100px;'></td>";
        // Mostrar un enlace para descargar el archivo comprimido
        echo "<td><a href='descargar_archivo.php?id=" . $row['id_juego'] . "'>Descargar Archivo</a></td>";
        // Aquí podrías agregar botones para editar o eliminar el juego si lo deseas
        echo "<td><button type='button' class='btn btn-primary' >Editar</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No se encontraron juegos aprobados.</td></tr>";
}

// Cerrar conexión y statement
$stmt->close();
$conn->close();
?>

