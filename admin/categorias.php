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
                        <th class="tea">Nombre</th>
                        <th class="tea">Imagen</th>
                        <th class="tea">Descripción</th>
                        <th class="tea">Acciones</th>
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
                        echo "<td class='tea'>" . $row['id_categoria'] . "</td>";
                        echo "<td class='tea'>" . $row['nombre_categoria'] . "</td>";
                        echo "<td class='tea'><img src='data:image/jpeg;base64," . base64_encode($row['imagen_categoria']) . "' width='50' height='50'></td>";
                        echo "<td class='tea'>" . $row['descripcion_categoria'] . "</td>";
                        echo "<td class='tea'><button type='button' class='btn btn-primary' onclick='verCategoria(" . $row['id_categoria'] . ")' data-bs-toggle='modal' data-bs-target='#modalVerCategoria'>Ver Detalles</button></td>";
                        echo "</tr>";
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevaCategoria" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_categoria" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_categoria" name="descripcion_categoria"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_categoria" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen_categoria" name="imagen_categoria" accept="image/*">
                        <img id="imagen_previa" src="#" alt="Imagen seleccionada" style="display: none; margin-top: 10px; max-width: 100%;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarNuevaCategoria()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver y editar detalles de la categoría -->
<div class="modal fade" id="modalVerCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVerCategoria" enctype="multipart/form-data">
                    <input type="hidden" id="id_categoria_ver" name="id_categoria">
                    <div class="mb-3">
                        <label for="nombre_categoria_ver" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_categoria_ver" name="nombre_categoria">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_categoria_ver" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_categoria_ver" name="descripcion_categoria"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_categoria_ver" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen_categoria_ver" name="imagen_categoria" accept="image/*">
                        <img id="imagen_previa_ver" src="#" alt="Imagen seleccionada" style="display: none; margin-top: 10px; max-width: 100%;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarCategoria()">Guardar</button>
            </div>
        </div>
    </div>
</div>

    <script>
        
        

        function verCategoria(idCategoria) {
    $.ajax({
        type: 'POST',
        url: 'obtener_detalle_categoria.php',
        data: { id_categoria: idCategoria },
        success: function(response) {
            var categoria = JSON.parse(response);

            $('#id_categoria_ver').val(categoria.id_categoria);
            $('#nombre_categoria_ver').val(categoria.nombre_categoria);
            $('#descripcion_categoria_ver').val(categoria.descripcion_categoria);

            if (categoria.imagen_categoria) {
                $('#imagen_previa_ver').attr('src', 'data:image/jpeg;base64,' + categoria.imagen_categoria).show();
            } else {
                $('#imagen_previa_ver').hide();
            }

            $('#modalVerCategoria').modal('show');
        }
    });
}

$('input[name=imagen_categoria_ver]').change(function() {
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagen_previa_ver').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    }
});

        document.getElementById('imagen_categoria').addEventListener('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('imagen_previa');
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        function guardarNuevaCategoria() {
            var formData = new FormData($('#formNuevaCategoria')[0]);
            $.ajax({
                type: 'POST',
                url: 'guardar_nueva_categoria.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response === "success") {
                        alert('Categoría añadida');
                        location.reload();
                    } else {
                        alert('Error al añadir la categoría');
                    }
                }
            });
        }

        function guardarCategoria() {
            var formData = new FormData($('#formVerCategoria')[0]);
            $.ajax({
                type: 'POST',
                url: 'actualizar_categoria.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Datos guardados');
                    location.reload();
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
