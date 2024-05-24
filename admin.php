<?php
session_start();

require_once 'conexion.php';

// Verificar si el usuario ha iniciado sesión y si es administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'administrador') {
    // Si el usuario no ha iniciado sesión o no es administrador, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit; // Asegura que el script se detenga aquí
}

// Obtener el nombre del administrador
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();
$stmt = $conn->prepare("SELECT nombre_usuario FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$stmt->bind_result($nombre_administrador);
$stmt->fetch();
$stmt->close();
$conexion->cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding: 20px 0;
            background-color: #343a40;
            color: #fff;
        }

        .sidebar ul.nav flex-column {
            padding-left: 0;
        }

        .sidebar ul.nav a.nav-link {
            color: #adb5bd;
            border-bottom: 1px solid #495057;
        }

        .sidebar ul.nav a.nav-link.active {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Panel Administrativo</span>
            <a href="ingreso.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-th"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-gamepad"></i> Juegos
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido -->
    <div class="content">
        <h2>Dashboard</h2>
        <h2>Hola <?php echo $nombre_administrador ?></h2>
        <p>Bienvenido al panel administrativo.</p>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

