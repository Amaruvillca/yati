<?php
require_once '../conexion.php';
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

$idCategoria = $_POST['id_categoria'];

$stmt = $conn->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
$stmt->bind_param("i", $idCategoria);
$stmt->execute();
$result = $stmt->get_result();
$categoria = $result->fetch_assoc();

if ($categoria['imagen_categoria']) {
    $categoria['imagen_categoria'] = base64_encode($categoria['imagen_categoria']);
}

echo json_encode($categoria);
?>
