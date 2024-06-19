<?php
// Datos de conexión a la base de datos
$servername = "localhost";   // Nombre del servidor de la base de datos
$username = "root";          // Nombre de usuario de la base de datos
$password = "root";          // Contraseña del usuario de la base de datos
$dbname = "yatini"; // Nombre de la base de datos que deseas utilizar

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer juego de caracteres a UTF-8
$conn->set_charset("utf8");

// Aquí puedes incluir otras configuraciones de conexión si las necesitas

?>
