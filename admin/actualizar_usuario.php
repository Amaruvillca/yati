<?php
require_once '../conexion.php';

$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$gmail = $_POST['gmail'];
$contrasena = $_POST['contrasena'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];

$stmt = $conn->prepare("UPDATE usuarios SET nombre_usuario = ?, gmail = ?, contrasena = ?, tipo = ?, estado = ? WHERE id_usuario = ?");
$stmt->bind_param("sssssi", $nombre_usuario, $gmail, $contrasena, $tipo, $estado, $id_usuario);

if ($stmt->execute()) {
    echo "Datos actualizados correctamente";
} else {
    echo "Error al actualizar los datos";
}

$stmt->close();
$conn->close();
?>
