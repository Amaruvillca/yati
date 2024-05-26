<?php
session_start();

require_once '../conexion.php';

// Verificar si el usuario ha iniciado sesión y si es administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'administrador') {
    // Si el usuario no ha iniciado sesión o no es administrador, redirigirlo a la página de inicio de sesión
    header("Location: ../ingreso.php");
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

    
    <link rel="icon" type="image/png" href="../img/l7.png">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Panel Administrativo</span>

            <div class="boton">
                <a href="#" class="usu"><i class="fas fa-user k"></i><?php  echo $nombre_administrador; ?></a>
                <a href="../ingreso.php" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            </div>

        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-details logo">
            <img src="../img/l7.png" alt="logo">
            <div class="logo_name">
                <h5>Administrador</h5>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item  ">
                <a class="nav-link active <?php if ($currentPage == 'Dashboard') echo 'actives'; ?>" href="admin.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == 'Usuarios') echo 'actives'; ?>" href="usuarios.php">
                    <i class="fas fa-users"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == 'Categorias') echo 'actives'; ?>" href="categorias.php">
                    <i class="fas fa-th"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == 'Juegos') echo 'actives'; ?>" href="juegos.php">
                    <i class="fas fa-gamepad"></i> Juegos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == 'En revision') echo 'actives'; ?>" href="revicsion.php">
                    <i class="fas fa-exclamation-circle"></i> En revisión
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == 'Rechazados') echo 'actives'; ?>" href="rechazados.php">
                    <i class="fas fa-times-circle"></i> Rechazados
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido -->
