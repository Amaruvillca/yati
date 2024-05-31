<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Juego</title>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            display: block;
            place-items: center;
            width: 800px;
            padding-left: 180px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .card-title {
            font-size: 24px;
            margin-bottom: 0;
        }
        .card-body {
            padding: 20px;
        }
        .card-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Detalles del Juego</h2>
            </div>
            <div class="card-body">
                <?php
                require_once '../conexion.php';

                $conexion = new Conexion();
                $conn = $conexion->obtenerConexion();

                if (isset($_GET['id'])) {
                    $id_juego = $_GET['id'];
                    $stmt = $conn->prepare("SELECT * FROM juegos WHERE id_juego = ?");
                    $stmt->bind_param("i", $id_juego);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $juego = $result->fetch_assoc();

                    // Obtiene el nombre del usuario que subió el juego
                    $stmt_user = $conn->prepare("SELECT id_usuario, nombre_usuario FROM usuarios WHERE id_usuario = ?");
                    $stmt_user->bind_param("i", $juego['id_usuario']);
                    $stmt_user->execute();
                    $result_user = $stmt_user->get_result();
                    $usuario = $result_user->fetch_assoc();

                    echo "<p><strong>ID del Juego:</strong> " . $juego['id_juego'] . "</p>";
                    echo "<p><strong>Nombre:</strong> " . $juego['nombre_juego'] . "</p>";
                    echo "<p><strong>Descripción:</strong> " . $juego['Descripcion'] . "</p>";
                    echo "<p><strong>Fecha de Creación:</strong> " . $juego['fecha_creacion'] . "</p>";
                    echo "<p><strong>URL:</strong> <a href='" . $juego['url_juego'] . "' target='_blank'>Ver juego</a></p>";
                    echo "<p><strong>Edad:</strong> " . $juego['edad'] . "</p>";
                    echo "<p><strong>Categoría:</strong> " . obtenerNombreCategoria($conn, $juego['id_categoria']) . "</p>";
                    echo "<p><strong>Estado de Revisión:</strong> " . $juego['estado_revision'] . "</p>";

                    // Muestra el ID y el nombre del usuario que subió el juego
                    echo "<p><strong>ID del Usuario que lo Subió:</strong> " . $usuario['id_usuario'] . "</p>";
                    echo "<p><strong>Usuario que lo Subió:</strong> " . $usuario['nombre_usuario'] . "</p>";
                    

                    $sql = "SELECT id_juego, ROUND(AVG(Puntuacion), 1) AS promedio_puntuacion 
                    FROM califica 
                    WHERE id_juego = $id_juego 
                    GROUP BY id_juego";
            
            // Ejecutar la consulta
            $resultado = $conn->query($sql);
            
            // Verificar si hay resultados y mostrarlos
            if ($resultado->num_rows > 0) {
                // Mostrar los datos obtenidos
                while ($fila = $resultado->fetch_assoc()) {
                    //echo "ID del Juego: " . $fila["id_juego"] . "<br>";
                    //echo "Promedio de Puntuación: " . $fila["promedio_puntuacion"];
                    echo"<p><strong>Calificación:</strong>  " . $fila["promedio_puntuacion"]. " </p>";
                }
            } else {
                echo "<p><strong>Calificación: No se encontraron resultados.</strong></p>";
            }



                    

                    // Muestra la imagen si está almacenada en la base de datos
                    if (!empty($juego['imagen_juego'])) {
                        echo "<img src='data:image/jpeg;base64," . base64_encode($juego['imagen_juego']) . "' class='card-img' alt='Imagen de juego'>";
                    }

                    // Muestra el archivo comprimido si está almacenado en la base de datos
                    if (!empty($juego['archivo_comprimido'])) {
                        echo "<p><strong>Archivo Comprimido:</strong> <a href='descargar.php?id=" . $juego['id_juego'] . "' class='btn btn-primary' role='button'>Descargar</a></p>";
                    }

                    // Botón para abrir ventana modal de edición
                    echo "<button type='button' class='btn btn-primary EDIT' data-toggle='modal' data-target='#editarModal'>EDITAR</button>";
                    echo "<a href='javascript:history.go(-1)' class='btn-back'>Volver</a>";
                } else {
                    echo "<p>No se ha proporcionado un ID de juego válido</p>";
                }

                function obtenerNombreCategoria($conn, $id_categoria) {
                    $nombre_categoria=null;
                    $stmt = $conn->prepare("SELECT nombre_categoria FROM categoria WHERE id_categoria = ?");
                    $stmt->bind_param("i", $id_categoria);
                    $stmt->execute();
                    $stmt->bind_result($nombre_categoria);
                    $stmt->fetch();
                    $stmt->close();
                    return $nombre_categoria;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Juego: <?php echo $juego['nombre_juego']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de Edición -->
                    <form id="editarJuegoForm" action="editar_juego.php" method="post">
                        <input type="hidden" name="id_juego" value="<?php echo $juego['id_juego']; ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre del Juego</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $juego['nombre_juego']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea readonly class="form-control" id="descripcion" name="descripcion"><?php echo $juego['Descripcion']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select readonly class="form-control" id="categoria" name="categoria">
                                <?php
                                $stmt_categoria = $conn->prepare("SELECT id_categoria, nombre_categoria FROM categoria");
                                $stmt_categoria->execute();
                                $result_categoria = $stmt_categoria->get_result();
                                while ($categoria = $result_categoria->fetch_assoc()) {
                                    $selected = $categoria['id_categoria'] == $juego['id_categoria'] ? "selected" : "";
                                    echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nombre_categoria'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">URL del Juego</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?php echo $juego['url_juego']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="estado_revision">Estado de Revisión</label>
                            <select class="form-control" id="estado_revision" name="estado_revision">
                                <option value="Pendiente" <?php echo $juego['estado_revision'] == 'En revisión' ? 'selected' : ''; ?>>En revisión</option>
                                <option value="Aprobado" <?php echo $juego['estado_revision'] == 'Aprobado' ? 'selected' : ''; ?>>Aprobado</option>
                                <option value="Rechazado" <?php echo $juego['estado_revision'] == 'Rechazado' ? 'selected' : ''; ?>>Rechazado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
