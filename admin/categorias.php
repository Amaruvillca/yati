<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Yatiñi Categorías</title>
    <?php
    $currentPage = 'Categorias';
    include 'header.php';
    ?>
</head>
<body>
    <div class="content" id="Dashboard">
        <h2 class="mb-4">Categorías</h2>
        <div class="mb-3 search-add-container">
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <input type="text" id="buscarCategoria" class="form-control" placeholder="Buscar categoría...">
                    </div>
                    <button type="button" class="btn btn-success col-2" data-bs-toggle="modal" data-bs-target="#modalNuevaCategoria">Nuevo</button>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="tea">#</th>
                        <th  class="tea">Nombre</th>
                        <th  class="tea">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaCategorias">
                    <?php
                    require_once '../conexion.php';
                    $conexion = new Conexion();
                    $conn = $conexion->obtenerConexion();

                    $categoriasPorPagina = 50;
                    $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($paginaActual - 1) * $categoriasPorPagina;

                    $stmt = $conn->prepare("SELECT * FROM categoria LIMIT ? OFFSET ?");
                    $stmt->bind_param("ii", $categoriasPorPagina, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class=tea>" . $row['id_categoria'] . "</td>";
                        echo "<td class=tea>" . $row['nombre_categoria'] . "</td>";
                        echo "<td class=tea><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalCategoria" . $row['id_categoria'] . "'>Ver Detalles</button></td>";
                        echo "</tr>";

                        echo "<div class='modal fade' id='modalCategoria" . $row['id_categoria'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                        echo "<div class='modal-dialog modal-dialog-centered'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='exampleModalLabel'>Detalles de la Categoría</h5>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "<form id='formCategoria" . $row['id_categoria'] . "'>";
                        echo "<input type='hidden' name='id_categoria' value='" . $row['id_categoria'] . "'>";
                        echo "<div class='mb-3'>";
                        echo "<label for='nombre_categoria' class='form-label'>Nombre</label>";
                        echo "<input type='text' class='form-control' name='nombre_categoria' value='" . $row['nombre_categoria'] . "'>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>";
                        echo "<button type='button' class='btn btn-primary' onclick='guardarCategoria(" . $row['id_categoria'] . ")'>Guardar</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM categoria");
        $totalCategorias = $stmt->fetch_assoc()['total'];
        $totalPaginas = ceil($totalCategorias / $categoriasPorPagina);

        if ($totalPaginas > 1) {
            echo "<nav aria-label='Page navigation'>";
            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<li class='page-item " . ($i == $paginaActual ? 'active' : '') . "'><a class='page-link' href='categorias.php?page=" . $i . "'>" . $i . "</a></li>";
            }
            echo "</ul>";
            echo "</nav>";
        }
        ?>
    </div>

    <!-- Modal para añadir nueva categoría -->
    <div class="modal fade" id="modalNuevaCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class="modal-body">
                    <form id="formNuevaCategoria">
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_categoria">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss='modal'>Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarNuevaCategoria()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function guardarCategoria(idCategoria) {
            var formId = '#formCategoria' + idCategoria;
            var formData = $(formId).serialize();

            $.ajax({
                type: 'POST',
                url: 'actualizar_categoria.php',
                data: formData,
                success: function(response) {
                    alert('Datos guardados');
                    location.reload(); // Recargar la página para reflejar los cambios
                }
            });
        }

        function guardarNuevaCategoria() {
            var formData = $('#formNuevaCategoria').serialize();

            $.ajax({
                type: 'POST',
                url: 'guardar_nueva_categoria.php', // Debes crear este archivo para manejar la inserción de la nueva categoría
                data: formData,
                success: function(response) {
                    alert('Categoría añadida');
                    location.reload(); // Recargar la página para reflejar los cambios
                }
            });
        }

        $(document).ready(function() {
            $('#buscarCategoria').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#tablaCategorias tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
