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

// Obtener categorías con la cantidad de juegos por categoría
$sql = "
SELECT 
    c.nombre_categoria, 
    c.imagen_categoria, 
    c.descripcion_categoria, 
    COUNT(j.id_juego) AS cantidad_juegos
FROM 
    categoria c
LEFT JOIN 
    juegos j ON c.id_categoria = j.id_categoria AND j.estado_revision = 'Aprobado'
GROUP BY 
    c.id_categoria
";

$result = $conn->query($sql);

$categorias = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

$conn->close();
?>
