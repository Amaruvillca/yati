

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Yatiñi Usuarios</title>
    <?php
    $currentPage = 'Usuarios';
    include 'header.php'
     ?>

<<div class="content" id="Dashboard">
        <h2 class="mb-4">Usuarios</h2>
        <div class="mb-3 search-add-container ">
            <div class="container">
                <div class="row">
                    <div class="col-10"><input type="text" id="buscarUsuario" class="form-control "  placeholder="Buscar usuario..."></div>
                
            <button type="button" class="btn btn-success col-2" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">Nuevo</button>
                </div>
            </div>
            
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaUsuarios">
                    <?php
                    require_once '../conexion.php';
                    $conexion = new Conexion();
                    $conn = $conexion->obtenerConexion();

                    $usuariosPorPagina = 100;
                    $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($paginaActual - 1) * $usuariosPorPagina;

                    $stmt = $conn->prepare("SELECT * FROM usuarios LIMIT ? OFFSET ?");
                    $stmt->bind_param("ii", $usuariosPorPagina, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_usuario'] . "</td>";
                        echo "<td>" . $row['nombre_usuario'] . "</td>";
                        echo "<td>" . $row['gmail'] . "</td>";
                        echo "<td>" . $row['contrasena'] . "</td>";
                        echo "<td>" . $row['tipo'] . "</td>";
                        echo "<td><span class='badge " . ($row['estado'] == 'activo' ? 'bg-success' : 'bg-danger') . "'>" . $row['estado'] . "</span></td>";
                        echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalUsuario" . $row['id_usuario'] . "'>VER</button>
                        <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#modalUsuario" . $row['id_usuario'] . "'>JUEGOS</button>
                        </td>";
                        echo "</tr>";

                        echo "<div class='modal fade' id='modalUsuario" . $row['id_usuario'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                        echo "<div class='modal-dialog modal-dialog-centered'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='exampleModalLabel'>Detalles del Usuario</h5>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "<form id='formUsuario" . $row['id_usuario'] . "'>";
                        echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>";
                        echo "<div class='mb-3'>";
                        echo "<label for='nombre_usuario' class='form-label'>Nombre</label>";
                        echo "<input type='text' class='form-control' name='nombre_usuario' value='" . $row['nombre_usuario'] . "'>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='gmail' class='form-label'>Email</label>";
                        echo "<input type='email' class='form-control' name='gmail' value='" . $row['gmail'] . "'>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='contrasena' class='form-label'>Contraseña</label>";
                        echo "<input type='text' class='form-control' name='contrasena' value='" . $row['contrasena'] . "'>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='tipo' class='form-label'>Rol</label>";
                        echo "<select class='form-select' name='tipo'>";
                        echo "<option value='administrador'" . ($row['tipo'] == 'administrador' ? ' selected' : '') . ">Administrador</option>";
                        echo "<option value='usuario'" . ($row['tipo'] == 'usuario' ? ' selected' : '') . ">Usuario</option>";
                        echo "</select>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='estado' class='form-label'>Estado</label>";
                        echo "<select class='form-select' name='estado'>";
                        echo "<option value='activo'" . ($row['estado'] == 'activo' ? ' selected' : '') . ">Activo</option>";
                        echo "<option value='no activo'" . ($row['estado'] == 'no activo' ? ' selected' : '') . ">No Activo</option>";
                        echo "</select>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>";
                        echo "<button type='button' class='btn btn-primary' onclick='guardarUsuario(" . $row['id_usuario'] . ")'>Guardar</button>";
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
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
        $totalUsuarios = $stmt->fetch_assoc()['total'];
        $totalPaginas = ceil($totalUsuarios / $usuariosPorPagina);

        if ($totalPaginas > 1) {
            echo "<nav aria-label='Page navigation'>";
            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<li class='page-item " . ($i == $paginaActual ? 'active' : '') . "'><a class='page-link' href='usuarios.php?page=" . $i . "'>" . $i . "</a></li>";
            }
            echo "</ul>";
            echo "</nav>";
        }
        ?>
    </div>

    <!-- Modal para añadir nuevo usuario -->
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoUsuario">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_usuario">
                        </div>
                        <div class="mb-3">
                            <label for="gmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="gmail">
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" name="contrasena">
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Rol</label>
                            <select class="form-select" name="tipo">
                                <option value="administrador">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado">
                                <option value="activo">Activo</option>
                                <option value="no activo">No Activo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarNuevoUsuario()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function guardarUsuario(idUsuario) {
            var formId = '#formUsuario' + idUsuario;
            var formData = $(formId).serialize();

            $.ajax({
                type: 'POST',
                url: 'actualizar_usuario.php',
                data: formData,
                success: function(response) {
                    alert('Datos guardados');
                    location.reload(); // Recargar la página para reflejar los cambios
                }
            });
        }

        function guardarNuevoUsuario() {
            var formData = $('#formNuevoUsuario').serialize();

            $.ajax({
                type: 'POST',
                url: 'guardar_nuevo_usuario.php', // Debes crear este archivo para manejar la inserción del nuevo usuario
                data: formData,
                success: function(response) {
                    alert('Usuario añadido');
                    location.reload(); // Recargar la página para reflejar los cambios
                }
            });
        }

        $(document).ready(function() {
            $('#buscarUsuario').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#tablaUsuarios tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });
        });
    </script>
    <script>
    function guardarNuevoUsuario() {
        var formData = $('#formNuevoUsuario').serialize();

        $.ajax({
            type: 'POST',
            url: 'guardar_nuevo_usuario.php',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    alert('Usuario añadido exitosamente');
                    $('#modalNuevoUsuario').modal('hide'); // Cerrar la ventana modal después de guardar el usuario
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert('Error al añadir usuario');
                }
            }
        });
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

