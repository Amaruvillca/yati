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

// Obtener juegos más populares
$sql = "
SELECT j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, c.nombre_categoria, AVG(cal.Puntuacion) AS promedio_puntuacion, j.fecha_creacion
FROM juegos j
JOIN categoria c ON j.id_categoria = c.id_categoria
JOIN califica cal ON j.id_juego = cal.id_juego
WHERE j.estado_revision = 'Aprobado'
GROUP BY j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, c.nombre_categoria, j.fecha_creacion
HAVING promedio_puntuacion >= 4.5
ORDER BY promedio_puntuacion DESC, j.fecha_creacion DESC
LIMIT 9
";

$result = $conn->query($sql);

$juegos_populares = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Convertir imagen a base64
        $row['imagen_juego'] = base64_encode($row['imagen_juego']);
        $juegos_populares[] = $row;
    }
}

$conn->close();
?>