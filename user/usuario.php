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

    <?php include('header.php'); ?>
    
</head>

<body>
    
    <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class=" slider_con col-lg-6 col-sm-12">
                            <img src="../img/l7.png" class="d-block w-100" alt="...">
                        </div>
                        <div class=" slider_con col-lg-6 col-sm-12 d-flex align-items-center">
                            <div>
                                <h1>Hola</h1>
                                <p>Descripción para la primera imagen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class=" slider_con col-lg-6 col-sm-12">
                            <img src="../img/l.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class=" slider_con col-lg-6 col-sm-12 d-flex align-items-center">
                            <div class="descripcion">
                                <h1>TV</h1>
                                <p>Descripción para la segunda imagen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class=" slider_con col-lg-6 col-sm-12">
                            <img src="../img/fondo4.avif" class="d-block w-100" alt="...">
                        </div>
                        <div class=" slider_con col-lg-6 col-sm-12 d-flex align-items-center">
                            <div>
                                <h1>Título</h1>
                                <p>Descripción para la tercera imagen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class=" slider_con col-lg-6 col-sm-12">
                            <img src="../img/fondo4.avif" class="d-block w-100" alt="...">
                        </div>
                        <div class=" slider_con col-lg-6 col-sm-12 d-flex align-items-center">
                            <div>
                                <h1>Título</h1>
                                <p>Descripción para la tercera imagenes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <div style="height: 10000px;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var carouselElement = document.querySelector('#carouselExampleCaptions');
            carouselElement.addEventListener('wheel', function (e) {
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
