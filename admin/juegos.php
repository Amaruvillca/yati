<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi juegos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
    $currentPage = 'Juegos';
    include 'header.php';
    ?>

<body>
    <div class="container juegos">
        <h1>Juegos</h1>

        <!-- Buscador y botón para añadir nuevo juego -->
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="buscarJuego" class="form-control" placeholder="Buscar juego...">
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-success float-right" id="btnNuevoJuego" data-toggle="modal" data-target="#modalNuevoJuego">Nuevo Juego</button>
            </div>
        </div>

        <!-- Tabla para mostrar los juegos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>URL</th>
                    <th>Edad</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaJuegos">
                <!-- Aquí se cargarán los juegos mediante AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Modales -->
    <!-- Modal para añadir nuevo juego -->
    <div class="modal fade" id="modalNuevoJuego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Juego</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoJuego">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="url" class="form-control" id="url" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría:</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                <!-- Aquí se cargarán las categorías mediante AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo:</label>
                            <input type="file" class="form-control-file" id="archivo" name="archivo" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarJuego">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar juego -->
<div class="modal fade" id="modalEditarJuego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Juego</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalEditarJuegoBody">
                <!-- Aquí se cargará el formulario para editar el juego -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarEdicionJuego">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JavaScript y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para cargar juegos al cargar la página
            cargarJuegos();

            // Función para cargar juegos
            function cargarJuegos() {
                $.ajax({
                    type: 'GET',
                    url: 'cargar_juegos.php',
                    success: function(response) {
                        $('#tablaJuegos').html(response);
                    }
                });
            }

            // Función para buscar juegos
            $('#buscarJuego').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#tablaJuegos tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            // Mostrar modal para añadir nuevo juego al hacer clic en el botón "Nuevo Juego"
            $('#btnNuevoJuego').click(function() {
                $('#modalNuevoJuego').modal('show');
            });

            // Función para guardar un nuevo juego
            $('#btnGuardarJuego').click(function() {
                var formData = $('#formNuevoJuego').serialize();

                $.ajax({
                    type: 'POST',
                    url: 'guardar_nuevo_juego.php',
                    data: formData,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert('Juego añadido exitosamente');
                            $('#modalNuevoJuego').modal('hide'); // Cerrar modal
                            cargarJuegos(); // Recargar juegos
                        } else {
                            alert('Error al añadir juego');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
