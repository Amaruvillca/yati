<?php
require_once '../conexion.php';
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

$idCategoria = $_POST['id_categoria'];
$nombreCategoria = $_POST['nombre_categoria'];
$descripcionCategoria = $_POST['descripcion_categoria'];
$imagenCategoria = isset($_FILES['imagen_categoria']['tmp_name']) ? file_get_contents($_FILES['imagen_categoria']['tmp_name']) : null;

if ($imagenCategoria) {
    $stmt = $conn->prepare("UPDATE categoria SET nombre_categoria = ?, descripcion_categoria = ?, imagen_categoria = ? WHERE id_categoria = ?");
    $stmt->bind_param("sssi", $nombreCategoria, $descripcionCategoria, $imagenCategoria, $idCategoria);
} else {
    $stmt = $conn->prepare("UPDATE categoria SET nombre_categoria = ?, descripcion_categoria = ? WHERE id_categoria = ?");
    $stmt->bind_param("ssi", $nombreCategoria, $descripcionCategoria, $idCategoria);
}

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
