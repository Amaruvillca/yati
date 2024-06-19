<?php
// db.php - Archivo para la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "yatini";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los juegos aprobados con todos los datos incluyendo la imagen, ordenados por fecha_creacion DESC
$sql = "
SELECT j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, j.fecha_creacion, c.nombre_categoria, AVG(cal.Puntuacion) AS promedio_puntuacion
FROM juegos j
JOIN categoria c ON j.id_categoria = c.id_categoria
LEFT JOIN califica cal ON j.id_juego = cal.id_juego
WHERE j.estado_revision = 'Aprobado'
GROUP BY j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, j.fecha_creacion, c.nombre_categoria
ORDER BY j.fecha_creacion DESC
";

$result = $conn->query($sql);

$juegos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Convertir imagen a base64 (si es necesario)
        $imagen_juego_base64 = base64_encode($row['imagen_juego']);
        $row['imagen_juego'] = $imagen_juego_base64;
        $juegos[] = $row;
    }
}

$conn->close();
?>
