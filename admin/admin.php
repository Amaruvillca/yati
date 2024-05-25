
<?php
// Conexión a la base de datos y consultas SQL para contar registros
require_once '../conexion.php';

$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

// Consulta SQL para contar registros en la tabla usuarios
$stmtUsuarios = $conn->query("SELECT COUNT(*) AS totalUsuarios FROM usuarios");
$totalUsuarios = $stmtUsuarios->fetch_assoc()['totalUsuarios'];

// Consulta SQL para contar registros en la tabla categoría
$stmtCategorias = $conn->query("SELECT COUNT(*) AS totalCategorias FROM categoria");
$totalCategorias = $stmtCategorias->fetch_assoc()['totalCategorias'];

// Consulta SQL para contar registros en la tabla juegos
$stmtJuegos = $conn->query("SELECT COUNT(*) AS totalJuegos FROM juegos");
$totalJuegos = $stmtJuegos->fetch_assoc()['totalJuegos'];

// Consulta SQL para contar registros en la tabla califica
$stmtCalificaciones = $conn->query("SELECT COUNT(*) AS totalCalificaciones FROM califica");
$totalCalificaciones = $stmtCalificaciones->fetch_assoc()['totalCalificaciones'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Yatiñi Dashboard</title>
    <?php
    $currentPage = 'Dashboard';
    include 'header.php'
     ?>

<div class="content" >
        <h2 class="text-center mb-4">¡Bienvenido, <?php echo $nombre_administrador; ?>!</h2>
    <p class="lead text-center">Bienvenido al panel administrativo.</p>
        <!-- Tabla larga -->
        
        <div class="row cart">
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text"><i class="fas fa-users"></i> <?php echo $totalUsuarios; ?></p>
                    <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <p class="card-text"><i class="fas fa-list-alt"></i> <?php echo $totalCategorias; ?></p>
                    <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Juegos</h5>
                    <p class="card-text"><i class="fas fa-gamepad"></i> <?php echo $totalJuegos; ?></p>
                    <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calificaciones</h5>
                    <p class="card-text"><i class="fas fa-star"></i> <?php echo $totalCalificaciones; ?></p>
                    <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="usuariosChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="juegosChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos para los gráficos (ejemplo)
    var usuariosData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
        datasets: [{
            label: "Usuarios Registrados",
            data: [120, 150, 180, 200, 220],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    var juegosData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
        datasets: [{
            label: "Juegos Creados",
            data: [50, 60, 70, 80, 90],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Configuración de los gráficos
    var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
        type: 'line',
        data: usuariosData
    });

    var juegosChart = new Chart(document.getElementById('juegosChart'), {
        type: 'bar',
        data: juegosData
    });
</script>
</body>

</html>

