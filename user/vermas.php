<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver más</title>
    <?php include('header.php'); // Incluir el encabezado ?>
    <!-- Incluir estilos CSS o librerías necesarias -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php include('juegos.php'); ?>

    
    <link rel="stylesheet" href="vermas.css">

    <div class="de" style="margin-top: 100px;">
       
    </div>

    <div class="mostrarjuego">
        <div class="container">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="co-6">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Sección de Video -->
            <div class="col-md-8">
                <div class="contenedor">
                    
                </div>
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
                        
                        echo '<div class="video-details">
                        <img  src="data:image/jpeg;base64,' . base64_encode($row['imagen_juego']) . '" class="card-img-top" alt="Imagen del Juego">';
                        echo '<h2 class="card-title">' . htmlspecialchars($row['nombre_juego']) . '</h2>';
                        echo '<p class="card-text">' . htmlspecialchars($row['Descripcion']) . '</p> ';
                        echo'<div class="video-actions">
                            <button class="btn"><i class="fas fa-share"></i> Compartir</button>
                            <button id="favoriteBtn" class="btn"><i class="fas fa-heart"></i> Favoritos</button>
                            
                             <div class="rating">
                                <span class="fa fa-star" data-rating="1"></span>
                                <span class="fa fa-star" data-rating="2"></span>
                                <span class="fa fa-star" data-rating="3"></span>
                                <span class="fa fa-star" data-rating="4"></span>
                                <span class="fa fa-star" data-rating="5"></span>
                            </div>
                            <a class="jugarahora" target="_blank" href="' . htmlspecialchars($row['url_juego']) . '">Jugar Ahora</a>
                        </div>
                        <div class="comments-section">
                        <h3>Comentarios</h3>
                        <!-- Añadir más contenido de comentarios aquí -->
                    </div>
                        </div>';
                     
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
            <!-- Sección de Videos Recomendados -->
            <?php foreach ($juegos as $juego): ?>
            <a href="vermas.php?id=<?= $juego['id_juego'] ?>">
                <div class="recommended-videos">
                    <div class="recommended-video">
                        <img src="data:image/jpeg;base64,<?= $juego['imagen_juego'] ?>" alt="Thumbnail del Video">
                       
                    </div>
                    <!-- Añadir más videos recomendados aquí -->
                </div>
                <div class="col-md-2">
            </div>
            </a>
            <?php endforeach; ?>
           
           
        </div>
    </div>

    <?php include('footer.php'); // Incluir el pie de página ?>

    <!-- Incluir scripts JavaScript o librerías necesarias -->
    <script src="scripts.js"></script>
    <script>
        // scripts.js
$(document).ready(function() {
    var $stars = $('.rating .fa-star');

    $stars.on('click', function() {
        var rating = $(this).data('rating');
        setRating(rating);
    });

    $stars.on('mouseover', function() {
        var rating = $(this).data('rating');
        highlightStars(rating);
    });

    $stars.on('mouseout', function() {
        var rating = $('.rating .fa-star.checked').last().data('rating') || 0;
        highlightStars(rating);
    });

    function setRating(rating) {
        $stars.each(function() {
            if ($(this).data('rating') <= rating) {
                $(this).addClass('checked');
            } else {
                $(this).removeClass('checked');
            }
        });
    }

    function highlightStars(rating) {
        $stars.each(function() {
            if ($(this).data('rating') <= rating) {
                $(this).addClass('checked');
            } else {
                $(this).removeClass('checked');
            }
        });
    }
});

    </script>
    <script>
        // scripts.js
$(document).ready(function() {
    $('#favoriteBtn').on('click', function() {
        var gameId = '1'; // Reemplaza esto con el ID dinámico del juego
        $.ajax({
            url: 'add_to_favorites.php',
            type: 'POST',
            data: { id: gameId },
            success: function(response) {
                // Maneja la respuesta del servidor
                if (response.status === 'success') {
                    alert('El juego ha sido añadido a tus favoritos.');
                } else {
                    alert('Hubo un problema al añadir el juego a tus favoritos.');
                }
            },
            error: function() {
                alert('Hubo un error en la solicitud.');
            }
        });
    });
});

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
