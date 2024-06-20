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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/user/user.css">
    <link rel="stylesheet" href="../css/user/tragetas.css">
    <link rel="stylesheet" href="pla/css/style.css">

    <?php include('header.php'); ?>
    <?php include('db.php'); ?>
    <?php include('juegospo.php'); ?>
    <?php include('juegos.php'); ?>

    
    

<body>
    <style>
        .carousel-caption {
            width: 100% !important;
            height: 100% !important;
            left: 0 !important;
            margin-left: 0px !important;
            margin-right: 0px !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
            top: 0 !important;
            bottom: 0 !important;
        }

        .carousel-indicators {
            margin-left: 0 !important;
            margin-right: 0px !important;
            padding-left: 10px !important;
        }

        .carousel-item {
            min-height: 300px;
            position: relative;
        }

        .carousel-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .booking-form-container {
            position: absolute;
            bottom: 1;
            left: 0;
            width: 100%;
            z-index: 10;
            background: transparent;

        }

        .color--naranja {
            color: #f3873f !important;
        }

        .fondo_naranja_y_letra {
            color: white !important;
            background-color: #f3873f !important;
            border: none;
        }
        .fondo_naranja_y_letra_jugar {
    color: white !important;
    background-color: #f3873f !important;
    border: none;
    width: 130px;
    height: 40px;
    border-radius: 10px;
    transition: transform 0.3s ease;
    display: grid;
    place-items: center;
    
}
.fondo_naranja_y_letra_jugar a{
    text-decoration: none;
}
.fondo_naranja_y_letra_jugar a:hover{
    text-decoration: none;
}

.fondo_naranja_y_letra_jugar:hover {
    
    background-color: #d17036 !important;
    text-decoration: none;
    
    transform: scale(1.1);
}

        .fondo--top {
            background-color: white !important;

        }

        .fondo--top--body {
            background-color: #F2F1F8 !important;
        }
    </style>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5" style="margin-top:70px;">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="pla/img/carousel-1.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Los mejores juegos para aprender</h5>
                            <h1 class="display-3 text-white mb-md-4">La mejor educación de tu hogar</h1>
                            <a href="" class="btn fondo_naranja_y_letra py-md-2 px-md-4 font-weight-semi-bold mt-2">Aprender Más</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="pla/img/carousel-2.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Los mejores juegos para aprender</h5>
                            <h1 class="display-3 text-white mb-md-4">Mejor Plataforma de Aprendizaje Online</h1>
                            <a href="" class="btn fondo_naranja_y_letra py-md-2 px-md-4 font-weight-semi-bold mt-2">Aprender Más</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="pla/img/carousel-3.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Los mejores juegos para aprender</h5>
                            <h1 class="display-3 text-white mb-md-4">Nueva manera de aprender de casa</h1>
                            <a href="" class="btn fondo_naranja_y_letra py-md-2 px-md-4 font-weight-semi-bold mt-2">Aprender Más</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="booking-form-container">
    <div class="container pb-5" style="margin-top: 0px;">
        <h2>Búsqueda de Juegos</h2>
        <div class="bg-light shadow" style="padding: 10px;">
            <div class="row align-items-center" style="min-height: 60px;">
                <div class="col-md-2">
                    <div class="mb-3 mb-md-0">
                        <input type="number" class="form-control p-4" placeholder="Edad mínima (5-10)" min="5" max="10">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3 mb-md-0">
                        <input type="number" class="form-control p-4" placeholder="Edad máxima (5-10)" min="5" max="10">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3 mb-md-0">
                        <select class="custom-select px-4" style="height: 47px;">
                            <option selected>Categoría</option>
                            <?php foreach ($categorias as $index => $categoria) : ?>
                            <option value="<?= $categoria['nombre_categoria'] ?>"><?= $categoria['nombre_categoria'] ?></option>
                            
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 mb-md-0">
                        <input type="text" class="form-control p-4" placeholder="Nombre del juego">
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn fondo_naranja_y_letra btn-block" type="submit" style="height: 47px; margin-top: -2px;">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
    <!-- About Start -->
    <div class="container-fluid py-5" style="margin-top: 100px;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="pla/img/about.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="text-left mb-4">
                        <h5 class="text-primary text-uppercase mb-3 color--naranja" style="letter-spacing: 5px; color: #f3873f;">Acerca de Nosotros</h5>
                        <h1>Camino innovador para aprender</h1>
                    </div>
                    <p>En nuestra plataforma de juegos educativos, exploramos un camino innovador para aprender, fusionando diversión y conocimiento. Nos dedicamos a crear experiencias educativas interactivas que inspiran el aprendizaje activo y fomentan el desarrollo integral de habilidades. Desde matemáticas hasta ciencias y más allá, nuestro objetivo es hacer que el aprendizaje sea accesible, estimulante y efectivo para todos los estudiantes</p>
                    <a href="" class="btn fondo_naranja_y_letra py-md-2 px-md-4 font-weight-semi-bold mt-2">Aprender Más</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Carousel End -->
    <!-- Category Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h5 class="text-primary color--naranja text-uppercase mb-3" style="letter-spacing: 5px;">Categorias</h5>
                <h2>Explora las categorias más importantes</h2>
            </div>
            <div class="row">
                <?php foreach ($categorias as $index => $categoria) : ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="cat-item position-relative overflow-hidden rounded mb-2">
                            <img class="img-fluid" src="data:image/jpeg;base64,<?= base64_encode($categoria['imagen_categoria']) ?>" class=" imageca d-block w-100" alt="<?= $categoria['nombre_categoria'] ?>" alt="">
                            <a class="cat-overlay text-white text-decoration-none" href="">
                                <h4 class="text-white font-weight-medium"><?= $categoria['nombre_categoria'] ?></h4>
                                <span> <?= $categoria['cantidad_juegos'] ?> juegos</span>
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
<style>
    .juego-imagen {
    width: 100%; /* Ajusta el ancho según sea necesario */
    height: auto; /* La altura se ajustará automáticamente para mantener la proporción */
    max-width: 100%; /* Asegura que la imagen no supere su tamaño original */
    max-height: 300px; /* Altura máxima para evitar imágenes demasiado grandes */
    object-fit: cover; /* Cubre el área de la imagen manteniendo la relación de aspecto */
}

</style>
    <!-- Category Start -->
    <!-- Courses Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary color--naranja text-uppercase mb-3" style="letter-spacing: 5px;">Juegos</h5>
                <h1>Juegos más populares</h1>
            </div>
            <div class="row">
            <?php foreach ($juegos_populares as $juego): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="rounded  overflow-hidden mb-2">
                        <img class="img-fluid juego-imagen" src="data:image/jpeg;base64,<?= $juego['imagen_juego'] ?>" alt="">
                        <div class="bg-secondary fondo--top  p-4">
                            <div class="d-flex justify-content-between mb-3">
                            <h6><?= htmlspecialchars($juego['nombre_juego']) ?></h6>
                                <small class="m-0"><i class="fas fa-folder-open color--naranja text-primary mr-2"></i> <?= htmlspecialchars($juego['nombre_categoria']) ?></small>
                            </div>
                           
                            <div class="border-top mt-4 pt-4">
                                <div class="d-flex justify-content-between">
                                
                                    <h6 class="m-0"><i class="fa fa-star color--naranja text-primary mr-2"></i><?= number_format($juego['promedio_puntuacion'], 2) ?></h6>
                                    <a href="vermas.php?id=<?= $juego['id_juego'] ?>" class="fondo_naranja_y_letra_jugar">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
   
    <!-- Courses End -->
    <div class="header">
        <div class="overlay"></div>
        <div class="content">
        <?php
    if ($estado) {
    ?>
            <h2 style="font-size: 100px;"><?php echo $nombre_usuario; ?></h2>

            <p>Bienvenido a tu perfil. ¡Explora tus juegos y logros!</p>
            <?php } else{?>
                <h2>¡Bienvenido!</h2>
                <p>Regístrate o inicia sesión para acceder a tus juegos y logros
                <?php }?>
        </div>
    </div>
    <?php
    if ($estado) {
    ?>
    <div class="container">
        <div class="statistics row text-center">
            <div class="col-md-6 stat">
                <h3>10</h3>
                <p>Juegos Jugados</p>
            </div>
            <div class="col-md-6 tat">
                <h3>25</h3>
                <p>Reseñas</p>
            </div>
            
        </div>
    </div>
    <?php } else{?>
        <div class="container mt-5">
            <center><img style="margin-bottom: 10px;" src="../img/l7.png" alt="logo" width="200px"></center>
            <center><h2 style="margin-bottom: 10px;">EduKids</h2></center>
            <br>
            <center>
            <div class="col-md-12 text-center">
                <h4 class="mb-4">¡Únete a nuestra comunidad!</h4>
                <p class="lead mb-4">Regístrate para acceder a más juegos educativos y contenidos exclusivos.</p>
                
            </div>
            </center>
    <div class="row">
        <div class="col-md-6 text-center">
            <a href="../ingreso.php" class="btn fondo_naranja_y_letra btn-lg btn-block">Iniciar Sesión</a>
        </div>
        <div class="col-md-6 text-center">
            <a href="../index.php" class="btn btn-secondary btn-lg btn-block">Registrarse</a>
        </div>
    </div>
</div>
        <?php } ?>
    <!-- Registration Start -->
    <!-- Sugerencias Start -->
<div class="container-fluid bg-registration py-5" style="margin-top: 90px;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="mb-4">
                    <h5 class="text-primary color--naranja text-uppercase mb-3" style="letter-spacing: 5px;">¿Tienes alguna sugerencia?</h5>
                    <h1 class="text-white">¡Ayúdanos a mejorar!</h1>
                </div>
                <p class="text-white">Queremos escuchar tus ideas y sugerencias para seguir mejorando nuestro servicio.</p>
                <ul class="list-inline text-white m-0">
                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Ayúdanos a mejorar tu experiencia en nuestro sitio.</li>
                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Tu opinión es valiosa para nosotros.</li>
                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Envíanos tus ideas y sugerencias hoy mismo.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-light text-center p-4">
                        <h2 class="m-0">Envía tus Sugerencias</h2>
                    </div>
                    <div class="card-body fondo_naranja_y_letra rounded-bottom bg-primary p-5">
                        <form action="procesar_sugerencias.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Tu Nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 p-4" placeholder="Tu Correo Electrónico" name="email" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control border-0 p-4" rows="5" placeholder="Escribe tus sugerencias aquí" name="sugerencia" required></textarea>
                            </div>
                            <button class="btn btn-dark btn-block border-0 py-3" type="submit">Enviar Sugerencia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sugerencias End -->

    <!-- Registration End -->
   
    <!-- <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($categorias as $index => $categoria) : ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($categorias as $index => $categoria) : ?>
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
    </div> -->


<style>
    .game-card {
    /* Ajusta el tamaño de la carta según sea necesario */
    height: 100%;
    height: 300px;
    /* Añade otros estilos de diseño si es necesario */
}

.game-card-img {
    /* Define el tamaño deseado para las imágenes dentro de las cartas */
    height: 200px; /* Ajusta la altura según tus necesidades */
    width: 100%; /* Establece el ancho al 100% para que se ajuste automáticamente */
    object-fit: cover; /* Ajusta el comportamiento de la imagen para cubrir completamente el espacio asignado */
}
</style>
    <div class="container">


        <div class="row">
            <h2 class="my-4">Todos los juegos</h2>
            <!-- Carta 1 -->
            <?php foreach ($juegos as $juego): ?>
               
            <div class="col-lg-3 col-md-6">
                <div class="card game-card">
                    <img src="data:image/jpeg;base64,<?= $juego['imagen_juego'] ?>" alt="Juego Favorito 1"alt="Juego Favorito 2">
                    <div class="card-body">
                        <h5 class="card-title game-card-title"><?= htmlspecialchars($juego['nombre_juego']) ?></h5>
                        <p class="card-text game-card-text"><?= htmlspecialchars($juego['nombre_categoria']) ?></p>
                        <a href="vermas.php?id=<?= $juego['id_juego'] ?>"  class="btn game-card-button">Ver más</a>
                    </div>
                </div>
            </div>
       
                <?php endforeach; ?>
          


        </div>
    </div>
    
   
    <!-- Resto del HTML aquí -->

    <!-- <script>
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
    </script> -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg fondo_naranja_y_letra btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="pla/lib/easing/easing.min.js"></script>
    <script src="pla/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="pla/mail/jqBootstrapValidation.min.js"></script>
    <script src="pla/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="pla/js/main.js"></script>

    <?php include('footer.php'); ?>