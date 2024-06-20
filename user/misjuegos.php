<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Juegos</title>
    <?php include('header.php'); ?>
    <?php include('db.php'); ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }


        .juego {
            background: #fff;
            padding: 20px;

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }

        .juego:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .juego img {
            width: 100px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .juego .detalle {
            flex: 1;
        }

        .juego h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        .juego p {
            color: #666;
            line-height: 1.6;
            margin: 5px 0;
        }

        .estado-revision {
            padding: 5px 10px;

            color: #fff;

            margin-top: 10px;
        }

        .estado-revision.Enrevisión {
            background-color: #f0ad4e;
        }

        .estado-revision.aprobado {
            background-color: #5cb85c;
        }

        .estado-revision.rechazado {
            background-color: #d9534f;
        }

        .botones button {
            padding: 10px 20px;


            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .boton-actualizar {
            background-color: #5cb85c;
            color: #fff;
        }

        .boton-actualizar:hover {
            background-color: #4cae4c;
        }

        .boton-eliminar {
            background-color: #d9534f;
            color: #fff;
            margin-left: 10px;
        }

        .boton-eliminar:hover {
            background-color: #c9302c;
        }

        .boton-flotante {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 2em;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .boton-flotante:hover {
            background-color: #4cae4c;
        }
    </style>
    <?php include('header.php'); ?>
</head>

<body>
    <center><h1 style="margin-top: 80px; margin-bottom: 10px;">Mis Juegos</h1></center>
    <?php
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo'] !== 'usuario') {
        echo "No estás autorizado para ver esta página.";
        exit;
    }

    // Obtener los juegos subidos por el usuario
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT 
                j.id_juego, 
                j.nombre_juego, 
                j.imagen_juego, 
                j.Descripcion, 
                c.nombre_categoria, 
                j.estado_revision, 
                j.fecha_creacion 
            FROM juegos j
            JOIN categoria c ON j.id_categoria = c.id_categoria
            WHERE j.id_usuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar los juegos subidos por el usuario
    echo "<div class='container'>";
    
    if ($result->num_rows > 0) {
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            $estadoRevisionClass = '';
            switch ($row['estado_revision']) {
                case 'En revisión':
                    $estadoRevisionClass = 'Enrevisión';
                    break;
                case 'Aprobado':
                    $estadoRevisionClass = 'aprobado';
                    break;
                case 'Rechazado':
                    $estadoRevisionClass = 'rechazado';
                    break;
            }
            echo "<div class='col-md-6'>";
            echo "<div class='juego'>";
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen_juego']) . '" alt="Imagen del juego" />';
            echo "<div class='detalle'>";
            echo "<h2>" . htmlspecialchars($row['nombre_juego']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['Descripcion']) . "</p>";
            echo "<p class='detalle'><strong>Categoría:</strong> " . htmlspecialchars($row['nombre_categoria']) . "</p>";
            echo "<p class='detalle'><strong>Estado de revisión:</strong> <span class='estado-revision " . $estadoRevisionClass . "'>" . htmlspecialchars($row['estado_revision']) . "</span></p>";
            echo "<p class='detalle'><strong>Fecha de creación:</strong> " . htmlspecialchars($row['fecha_creacion']) . "</p>";
            echo "<div class='botones'>";
            echo "<button class='btn btn-success boton-actualizar' onclick='actualizarJuego(" . $row['id_juego'] . ")'>Actualizar</button>";
            echo "<button class='btn btn-danger boton-eliminar' onclick='eliminarJuego(" . $row['id_juego'] . ")'>Eliminar</button>";
            echo "</div>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No has subido ningún juego todavía.</p>";
    }
    echo "</div>";

    $stmt->close();
    $conexion->cerrarConexion();
    ?>

    

    

    <button class="boton-flotante " onclick="location.href='crear_juego.php'">+</button>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function actualizarJuego(id) {
            // Redirigir a la página de actualización con el id del juego
            window.location.href = 'actualizar_juego.php?id=' + id;
        }

        function eliminarJuego(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este juego?')) {
                // Redirigir a la página de eliminación con el id del juego
                window.location.href = 'eliminar_juego.php?id=' + id;
            }
        }
    </script>

    <?php include('footer.php'); ?>
</body>

</html>