<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi Crear juego</title>
    <?php
    $currentPage = 'Juegos';
    include 'header.php';
    
    // Incluir archivo de conexión a la base de datos
    require_once '../conexion.php';

    // Crear una instancia de la clase Conexion
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();

    // Consulta SQL para obtener todas las categorías de juegos
    $sql = "SELECT id_categoria, nombre_categoria FROM categoria";
    $result = $conn->query($sql);
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 15px 15px 0 0;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
        }

        .form-control {
            border-radius: 10px;
            border-color: #ccc;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .custom-file-label {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5" style="margin-left: 180px;">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Crear juego
                    </div>
                    <div class="card-body">
                        <!-- Formulario para crear un nuevo juego -->
                        <form action="procesar_creacion_juego.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre_juego">Nombre del juego:</label>
                                <input type="text" id="nombre_juego" name="nombre_juego" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen_juego">Imagen del juego:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen_juego" name="imagen_juego" accept="image/*" required onchange="previewImage(this)">
                                    <label class="custom-file-label" for="imagen_juego">Seleccionar archivo</label>
                                </div>
                                <center>
                                <img id="preview" class="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
                                </center>
                                
                            </div>
                            <div class="form-group">
                                <label for="descripcion_juego">Descripción del juego:</label>
                                <textarea id="descripcion_juego" name="descripcion_juego" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="url_juego">URL del juego:</label>
                                <input type="url" id="url_juego" name="url_juego" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edad_juego">Edad recomendada:</label>
                                <input type="number" id="edad_juego" name="edad_juego" class="form-control" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="categoria_juego">Categoría del juego:</label>
                                <select id="categoria_juego" name="categoria_juego" class="form-control" required>
                                    <?php
                                    // Iterar sobre los resultados de la consulta y mostrar las opciones del select
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_categoria'] . "'>" . $row['nombre_categoria'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="archivo_juego">Archivo comprimido del juego:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo_juego" name="archivo_juego" accept=".zip,.rar" required>
                                    <label class="custom-file-label" for="archivo_juego">Seleccionar archivo</label>
                                </div>
                            </div>
                            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                            <button type="submit" class="btn btn-primary btn-block">Crear juego</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
