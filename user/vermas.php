<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver más</title>
    <?php include('header.php'); // Incluir el encabezado 
    ?>
    <!-- Incluir estilos CSS o librerías necesarias -->

</head>

<body>
    <?php include('juegos.php'); ?>
    <link rel="stylesheet" href="styles.css">


    <link rel="stylesheet" href="vermas.css">

    <div class="sepa" style="margin-top: 80px;"></div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 col-md-12">
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
                        $row = $result->fetch_assoc(); ?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['imagen_juego']) . '' ?>" alt="imagen" width="100%" height="450px">
                        </div>

                        <h3 class="mt-3"><?php echo '' . htmlspecialchars($row['nombre_juego'])  . ''; ?></h3>
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating sepa">
                                <span class="fa fa-star" data-rating="1"></span>
                                <span class="fa fa-star" data-rating="2"></span>
                                <span class="fa fa-star" data-rating="3"></span>
                                <span class="fa fa-star" data-rating="4"></span>
                                <span class="fa fa-star" data-rating="5"></span>
                            </div>
                            <!-- Botón de Share -->
<!-- Botón de Share -->
<button id="shareBtn" class="btn btn-outline-success mr-2"><i class="fas fa-share"></i> Share</button>

<!-- Ventana Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="modal-title" id="shareModalLabel">Compartir</h5></center>
                
                
            </div>
            <div class="modal-body text-center">
                <p>Selecciona cómo quieres compartir:</p>
                <button class="btn btn-success mb-2 share-option" id="shareWhatsapp">
                    <i class="fab fa-whatsapp"></i> Compartir por WhatsApp
                </button>
                <button class="btn btn-primary mb-2 share-option" id="shareFacebook">
                    <i class="fab fa-facebook"></i> Compartir por Facebook
                </button>
                <button class="btn btn-info mb-2 share-option" id="copyLink">
                    <i class="far fa-copy"></i> Copiar enlace
                </button>
            </div>
            
        </div>
    </div>
</div>


                            <button id="favoriteBtn" class="btn btn-outline-danger"><i class="fas fa-heart"></i> Favoritos</button>



                        </div>
                        <div class="video-info p-3 bg-light rounded">
                            <p class="mb-1"><strong>Descripcion:</strong></p>
                            <p class="mb-0"><?php echo '' . htmlspecialchars($row['Descripcion']) . ' '; ?></p>
                            <a class="jugarahora" target="_blank" href="<?php echo '' . htmlspecialchars($row['url_juego']) . '' ?>">Jugar Ahora</a>

                        </div>
                <?php } else {
                        echo '<p>No se encontró ningún juego con el ID proporcionado.</p>';
                    }

                    // Cerrar la consulta y la conexión
                    $stmt->close();
                    $conn->close();
                } else {
                    echo '<p>No se ha recibido el ID del juego.</p>';
                } ?>
                <hr>

                <hr>
                <div class="comments-section">
                    <h5>Comentarios</h5>
                    <div class="comment my-3">
                        <div class="d-flex align-items-start">
                            <img src="https://via.placeholder.com/40" class="rounded-circle mr-3" alt="User Avatar">
                            <div>
                                <p class="mb-0"><strong>User Name</strong></p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dolorem, dignissimos obcaecati veritatis magni saepe numquam omnis fugit minus asperiores eum mollitia voluptatem velit doloremque ut inventore explicabo, distinctio quisquam.</p>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-thumbs-up"></i> 10</button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i> 1</button>
                                    <button class="btn btn-sm btn-outline-dark ml-2"><i class="fas fa-reply"></i> Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment my-3">
                        <div class="d-flex align-items-start">
                            <img src="https://via.placeholder.com/40" class="rounded-circle mr-3" alt="User Avatar">
                            <div>
                                <p class="mb-0"><strong>Another User</strong></p>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo accusamus harum numquam beatae placeat. Magnam aut, voluptas maxime voluptatem unde neque alias! Accusamus repellat eos sequi, saepe reiciendis autem magni?</p>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-thumbs-up"></i> 5</button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i> 0</button>
                                    <button class="btn btn-sm btn-outline-dark ml-2"><i class="fas fa-reply"></i> Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 related-videos">
                <h5>Más juegos</h5>
                <div class="list-group">
                    <?php foreach ($juegos as $juego) : ?>
                        <a href="vermas.php?id=<?= $juego['id_juego'] ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-start">
                                <img src="data:image/jpeg;base64,<?= $juego['imagen_juego'] ?>" class="mr-3 rounded" alt="Related Video Thumbnail" height="10px">
                                <div style="margin-left: 8px;">
                                    <h4 class="mb-1"><?php echo ' ' . $juego['nombre_juego']; ?></h4>
                                    <h5 class="mb-0 text-muted"> categoria: <?= htmlspecialchars($juego['nombre_categoria']) ?></h5>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <?php include('footer.php'); // Incluir el pie de página 
    ?>
<script>
$(document).ready(function() {
    $('#favoriteBtn').click(function() {
        $(this).toggleClass('favorited'); // Alternar la clase 'favorited'
        var isFavorited = $(this).hasClass('favorited'); // Verificar si está marcado como favorito

        if (isFavorited) {
            // Si está marcado como favorito, cambiar el icono a lleno
            $(this).html('<i class="fas fa-heart"></i> Favoritos');
        } else {
            // Si no está marcado como favorito, cambiar el icono a vacío
            $(this).html('<i class="far fa-heart"></i> Favoritos');
        }

        // Aquí puedes agregar lógica adicional, como guardar el estado de favorito en el backend
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    // Mostrar modal al hacer clic en el botón Share
    $('#shareBtn').click(function() {
        $('#shareModal').modal('show');
    });

    // Compartir por WhatsApp
    $('#shareWhatsapp').click(function() {
        var url = window.location.href;
        var whatsappUrl = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(url);
        window.open(whatsappUrl, '_blank');
        $('#shareModal').modal('hide');
    });

    // Compartir por Facebook
    $('#shareFacebook').click(function() {
        var url = window.location.href;
        var facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);
        window.open(facebookUrl, '_blank');
        $('#shareModal').modal('hide');
    });

    // Copiar enlace al portapapeles
    $('#copyLink').click(function() {
        var url = window.location.href;
        navigator.clipboard.writeText(url)
            .then(function() {
                alert('Enlace copiado al portapapeles');
            })
            .catch(function(err) {
                console.error('Error al copiar el enlace: ', err);
            });
        $('#shareModal').modal('hide');
    });
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll('.fa-star');

    stars.forEach(function(star) {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            resetStars(); // Reinicia todas las estrellas antes de pintarlas de nuevo
            paintStars(rating); // Pinta las estrellas hasta el rating seleccionado
        });
    });

    function resetStars() {
        stars.forEach(function(star) {
            star.classList.remove('fas'); // Quita la clase 'fas' para mostrar la estrella vacía
            star.classList.add('far'); // Añade la clase 'far' para mostrar la estrella vacía
        });
    }

    function paintStars(rating) {
        for (let i = 0; i < rating; i++) {
            stars[i].classList.remove('far'); // Quita la clase 'far' para mostrar la estrella llena
            stars[i].classList.add('fas'); // Añade la clase 'fas' para mostrar la estrella llena
        }
    }
});
</script>
</body>

</html>