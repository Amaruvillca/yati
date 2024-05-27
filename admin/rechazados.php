<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi Rechazado</title>
    <?php
    $currentPage = 'Rechazados';
    include 'header.php';
    ?>
</head>
<body>
    <div class="content">
        <h2 class="mb-4">Rechazado</h2>
        <!-- Campo de búsqueda -->
        
        <div class="container">
            <div class="row col-12">
                <div class="col-9">
                <input type="text" id="searchInput" class="form-control " placeholder="Buscar juegos...">
                </div>
                <div class="col-3">
                <button class="btn btn-primary " onclick="location.href='crear_juego.php'">Nuevo</button>
            </div>
                </div>
           
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>URL</th>
                        <th>Edad</th>
                        <th>Categoría</th>
                        <th>Archivo Comprimido</th>
                        <th>Estado de Revisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../conexion.php';

                    $conexion = new Conexion();
                    $conn = $conexion->obtenerConexion();

                    $stmt = $conn->query("SELECT * FROM juegos WHERE estado_revision='Rechazado'");
                    while ($row = $stmt->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_juego'] . "</td>";
                        echo "<td>" . $row['nombre_juego'] . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagen_juego']) . "' alt='Imagen de juego' style='max-width: 100px; max-height: 100px;'>
                        
                        </td>";
                       

                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td><a href='" . $row['url_juego'] . "' target='_blank'>Ver juego</a></td>";
                        echo "<td>" . $row['edad'] . "</td>";
                        echo "<td>" . obtenerNombreCategoria($conn, $row['id_categoria']) . "</td>";
                        echo "<td><button class='btn btn-primary' onclick=\"location.href='descargar.php?id=" . $row['id_juego'] . "'\">Descargar</button></td>"; // Reemplaza descargar.php con el archivo donde manejes las descargas
                        echo "<td class='" . obtenerClaseEstado($row['estado_revision']) . "'> <P>" . $row['estado_revision'] . "</P></td>";
                        echo "<td class= 'po'>
                        <a href='ver_juego.php?id=" . $row['id_juego'] . "' class='btn btn-success'>VER</a>
                        </td>";
                        echo "</tr>";
                    }

                    function obtenerNombreCategoria($conn, $id_categoria) {
                        $stmt = $conn->prepare("SELECT nombre_categoria FROM categoria WHERE id_categoria = ?");
                        $stmt->bind_param("i", $id_categoria);
                        $stmt->execute();
                        $stmt->bind_result($nombre_categoria);
                        $stmt->fetch();
                        $stmt->close();
                        return $nombre_categoria;
                    }

                    function obtenerClaseEstado($estado) {
                        switch ($estado) {
                            case 'Aprobado':
                                return 'aprobado';
                            case 'En revisión':
                                return 'en-revision';
                            case 'Rechazado':
                                return 'rechazado';
                            default:
                                return '';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Agrega tus scripts adicionales aquí -->
    <script src="../js/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Script para filtrar la tabla automáticamente -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                var visible = false;
                for (var j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            visible = true;
                            break;
                        }
                    }
                }
                if (visible) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
