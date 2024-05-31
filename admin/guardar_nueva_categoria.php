<?php
require_once '../conexion.php';
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

$nombreCategoria = $_POST['nombre_categoria'];
$descripcionCategoria = $_POST['descripcion_categoria'];
$imagenCategoria = file_get_contents($_FILES['imagen_categoria']['tmp_name']);

$stmt = $conn->prepare("INSERT INTO categoria (nombre_categoria, descripcion_categoria, imagen_categoria) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombreCategoria, $descripcionCategoria, $imagenCategoria);
if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
