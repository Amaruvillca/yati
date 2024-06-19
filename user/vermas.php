<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver más</title>
    <!-- Incluir estilos CSS o librerías necesarias -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php include('header.php'); // Incluir el encabezado ?>

    <div class="container mt-5" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Detalles del Juego</h2>
                <hr>
                <?php
                // Incluir el archivo de conexión a la base de datos
                include('dbs.php');

                // Verificar si se ha recibido el parámetro id
                if (isset($_GET['id'])) {
                    // Obtener y sanear el id_juego
                    $id_juego = htmlspecialchars($_GET['id']);

                    // Consulta SQL para obtener los detalles del juego
                    $sql = "SELECT * FROM juegos WHERE id_juego = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_juego);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Mostrar los datos del juego
                        $row = $result->fetch_assoc();
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row['nombre_juego']) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>';
                        echo '<p class="card-text">Categoría: ' . htmlspecialchars($row['nombre_categoria']) . '</p>';
                        echo '<p class="card-text">Puntuación Promedio: ' . number_format($row['promedio_puntuacion'], 2) . '</p>';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen_juego']) . '" class="card-img-top" alt="Imagen del Juego">';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<p>No se encontró ningún juego con el ID proporcionado.</p>';
                    }

                    // Cerrar la consulta y la conexión
                    $stmt->close();
                    $conn->close();
                } else {
                    echo '<p>No se ha recibido el ID del juego.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include('footer.php'); // Incluir el pie de página ?>

    <!-- Incluir scripts JavaScript o librerías necesarias -->
    <script src="scripts.js"></script>
</body>
</html>
