<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatiñi</title>
    <link rel="stylesheet" href="../css/user/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/user/user.css">
    <link rel="stylesheet" href="../css/user/tragetas.css">

    <?php include('header.php'); ?>
    <?php include('db.php'); ?>

</head>

<body>

    <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($categorias as $index => $categoria) : ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
        <?php foreach ($categorias as $index => $categoria): ?>
                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                    <div class="container">
                        <div class="row">
                            <div class="slider_con col-lg-6 col-sm-12">
                                <img src="data:image/jpeg;base64,<?= base64_encode($categoria['imagen_categoria']) ?>" class=" imageca d-block w-100" alt="<?= $categoria['nombre_categoria'] ?>" width="100%" height="5px">
                            </div>
                            <div class="cont slider_con col-lg-6 col-sm-12 d-flex align-items-center">
                                <div class="descripcion">
                                    <div class="titulo">
                                        <h1><?= $categoria['nombre_categoria'] ?></h1>
                                    </div>
                                    <p><?= $categoria['descripcion_categoria'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="header">
        <div class="overlay"></div>
        <div class="content">
            <h1>Nombre del Usuario</h1>
            <p>Bienvenido a tu perfil. ¡Explora tus juegos y logros!</p>
        </div>
    </div>

    <div class="container">
        <div class="statistics row text-center">
            <div class="col-md-4 stat">
                <h3>10</h3>
                <p>Juegos Jugados</p>
            </div>
            <div class="col-md-4 stat">
                <h3>25</h3>
                <p>Reseñas</p>
            </div>
            <div class="col-md-4 stat">
                <h3>5</h3>
                <p>Logros</p>
            </div>
        </div>

        <div class="row">
            <h2 class="my-4">Juegos Favoritos</h2>
            <!-- Carta 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card game-card">
                    <img src="https://via.placeholder.com/300x300.png?text=Juego+Favorito+1" alt="Juego Favorito 1">
                    <div class="card-body">
                        <h5 class="card-title game-card-title">Juego Favorito 1</h5>
                        <p class="card-text game-card-text">¡Disfruta de una experiencia increíble!</p>
                        <a href="#" class="btn game-card-button">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Carta 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card game-card">
                    <img src="https://via.placeholder.com/300x300.png?text=Juego+Favorito+2" alt="Juego Favorito 2">
                    <div class="card-body">
                        <h5 class="card-title game-card-title">Juego Favorito 2</h5>
                        <p class="card-text game-card-text">¡Aventuras sin fin te esperan!</p>
                        <a href="#" class="btn game-card-button">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Carta 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card game-card">
                    <img src="https://via.placeholder.com/300x300.png?text=Juego+Favorito+3" alt="Juego Favorito 3">
                    <div class="card-body">
                        <h5 class="card-title game-card-title">Juego Favorito 3</h5>
                        <p class="card-text game-card-text">¡Descubre nuevos mundos!</p>
                        <a href="#" class="btn game-card-button">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Carta 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="card game-card">
                    <img src="https://via.placeholder.com/300x300.png?text=Juego+Favorito+4" alt="Juego Favorito 4">
                    <div class="card-body">
                        <h5 class="card-title game-card-title">Juego Favorito 4</h5>
                        <p class="card-text game-card-text">¡Un desafío a cada paso!</p>
                        <a href="#" class="btn game-card-button">Ver más</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="my-4">Todos los Juegos</h2>
            <!-- Agrega más tarjetas de juegos aquí -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var carouselElement = document.querySelector('#carouselExampleCaptions');
            carouselElement.addEventListener('wheel', function(e) {
                e.preventDefault(); // Prevenir el comportamiento de desplazamiento
                if (e.deltaY > 0) {
                    $('#carouselExampleCaptions').carousel('next');
                } else {
                    $('#carouselExampleCaptions').carousel('prev');
                }
            });
        });
    </script>
</body>

</html>