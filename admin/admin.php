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
$stmtUsuariosPorMes = $conn->query("SELECT COUNT(*) AS totalUsuarios, MONTH(fecha_registro) AS mes FROM usuarios WHERE YEAR(fecha_registro) = YEAR(CURRENT_DATE()) GROUP BY MONTH(fecha_registro)");
$usuariosPorMes = array_fill(0, 12, 0); // Inicializar el array con ceros para cada mes del año

// Llenar el array con los datos de la consulta
while ($row = $stmtUsuariosPorMes->fetch_assoc()) {
    $mes = intval($row['mes']) - 1; // Restar 1 para ajustar al índice del array (0-11)
    $usuariosPorMes[$mes] = intval($row['totalUsuarios']);
}
$stmtJuegosPorMes = $conn->query("SELECT COUNT(*) AS totalJuegos, MONTH(fecha_creacion) AS mes FROM juegos WHERE YEAR(fecha_creacion) = YEAR(CURRENT_DATE()) GROUP BY MONTH(fecha_creacion)");
$juegosPorMes = array_fill(0, 12, 0); // Inicializar el array con ceros para cada mes del año

// Llenar el array con los datos de la consulta
while ($row = $stmtJuegosPorMes->fetch_assoc()) {
    $mes = intval($row['mes']) - 1; // Restar 1 para ajustar al índice del array (0-11)
    $juegosPorMes[$mes] = intval($row['totalJuegos']);
}

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

    <div class="content">
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

    <div class="conteiner">
        <div class="row " style="margin-left: 180px;">
            <div class="col-md-12">
                <canvas id="usuariosChart"></canvas>
            </div>
            <div class="col-md-12">
                <canvas id="juegosChart"></canvas>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico de usuarios registrados por mes
        var usuariosData = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [{
                label: "Usuarios Registrados        ",
                data: <?php echo json_encode($usuariosPorMes); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                
            },{label: "Juegos Creados",
                data: <?php echo json_encode($juegosPorMes); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1}]
            

        };

        // Configuración del gráfico de usuarios
        var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
            type: 'line',
            data: usuariosData
        });
        // var juegosData = {
        //     labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        //     datasets: [{
        //         label: "Juegos Creados",
        //         data: <?php echo json_encode($juegosPorMes); ?>,
        //         backgroundColor: 'rgba(255, 99, 132, 0.2)',
        //         borderColor: 'rgba(255, 99, 132, 1)',
        //         borderWidth: 1
        //     }]
        // };

        // // Configuración del gráfico de juegos
        // var juegosChart = new Chart(document.getElementById('juegosChart'), {
        //     type: 'bar',
        //     data: juegosData
        // });
    </script>
    </script>
    </body>

</html>