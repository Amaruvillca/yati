<?php
error_reporting(0);
require_once '../conexion.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo'] !== 'usuario') {
    $estado = false;
} else {
    $estado = true;
    // Obtener el nombre del administrador
    $conexion = new Conexion();
    $conn = $conexion->obtenerConexion();
    $stmt = $conn->prepare("SELECT nombre_usuario FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $_SESSION['id_usuario']);
    $stmt->execute();
    $stmt->bind_result($nombre_usuario);
    $stmt->fetch();
    $stmt->close();

    $conexion->cerrarConexion();
}
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

// Consulta SQL para obtener todas las categorías de juegos
$sql = "SELECT id_categoria, nombre_categoria FROM categoria";
$result = $conn->query($sql);
?>

<link rel="icon" type="image/png" href="../img/l7.png">
<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
<script src="../js/bootrap/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="../css/user/style.css">
<link rel="stylesheet" href="../css/user/user.css">

</head>
<style>

</style>
<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="icon-container d-lg-none colap">
            <button class="btn btn-outline-secondary bonton_icono col" type="button" data-bs-toggle="modal" data-bs-target="#busquedaModal">
                <i class="material-icons">search</i>
            </button>
            <button class="btn btn-outline-secondary voz espacio col" type="button">
                <i class="material-icons">notifications</i>
            </button>
        </div>
        <a class="navbar-brand logo" href="usuario.php">
            <img src="../img/l7.png" alt="logo">
            <div class="navbar-text">
                
                <div class="titulo">Yatiñi</div>
            </div>
        </a>

        <button class="navbar-toggler botonam" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation" style="margin-right: 15px;">

            <span class="navbar-toggler-icon"></span>


        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
            <div class="offcanvas-header">
                <div class="offcanvas-title" id="offcanvasNavbarLabel">
                    <div class="inicio_registro">
                        <?php
                        if ($estado) {
                        ?>
                            <div class="usucomp">
                                <button class=" <?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?> inicia-sesion-btn " data-bs-placement="bottom"><?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?></button>
                                <p><?php echo $nombre_usuario; ?></p>
                            </div>
                            <div class="usucomp">
                                <a href="cerrar_sesion.php" class="salir navbar-text"><i class="material-icons cerrar-sesion-icon">exit_to_app</i></a>
                                <a href="cerrar_sesion.php">Cerrar Sesion</a>
                            </div>
                        <?php
                        } else {
                            echo '   <a href="../ingreso.php">Iniciar sesión</a>
                    <a href="../index.php">Regístrate</a>';
                        }
                        ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 navbar-text categorias">
                <?php
                    if ($estado) {
                    ?>
                        <ul class=" misju navbar-nav justify-content-end flex-grow-1 pe-3 navbar-text  listas">

                            <li class="nav-item ">
                                <a class=" misju nav-link" href="#" style="color: black;">Mis Juegos</a>
                            </li>

                        </ul>
                    <?php
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                            Categorias
                        </a>
                        <ul class="dropdown-menu">

                            <?php
                            // Iterar sobre los resultados de la consulta y mostrar las opciones del menú
                            while ($row = $result->fetch_assoc()) {
                                echo "<li><a class='dropdown-item' href='#'>" . $row['nombre_categoria'] . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                  
                </ul>
                <form class="d-flex mx-2 busqueda navbar-text " role="search">
                    <div class="input-group">
                        <input class="form-control busqueda_input bus" type="search" placeholder="Busca cualquier cosa" aria-label="Search">
                        <button class="btn btn-outline-secondary bonton_icono bus2" type="submit">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
                    <button class="btn btn-outline-secondary voz" type="button" id="micButton">
                        <i class="material-icons">mic</i>
                    </button>
                </form>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 navbar-text  listas">
                   
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Top Juegos</a>
                    </li>


                </ul>
                <div class="iconos">
                    <button class="btn btn-outline-secondary voz espacio notificaciones" type="button">
                        <i class="material-icons">notifications</i>
                    </button>
                    <button class="btn btn-outline-secondary voz espacio fav" type="button">
                        <i class="material-icons">favorite</i>
                        <a class="nav-link p" href="#">Favoritos</a>
                       
                    </button>
                    <li class="nav-item favvv" style="margin-right: 30px;">
                        <a class="nav-link" href="#" style="color: black;">Favoritos</a>
                    </li>
                    <style>
                        @media (max-width: 992px) {
.favvv{
    display: none;
}
                        }
                    </style>
                    
                </div>
                <div class="botones">
                    <?php
                    if ($estado) {
                    ?>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 navbar-text  listas">

                            <li class="nav-item mis">
                                <a class="nav-link" href="misjuegos.php" style="color: black;">Mis Juegos</a>
                            </li>

                        </ul>
                        <button class=" <?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?> inicia-sesion-btn " data-bs-placement="bottom"><?php echo strtoupper(substr($nombre_usuario, 0, 1)); ?></button>

                        <a href="cerrar_sesion.php" class="salir navbar-text"><i class="material-icons cerrar-sesion-icon">exit_to_app</i></a>
                    <?php
                    } else {
                        echo '<a href="../ingreso.php" ><button class="btn btn-primary espacio orange" >Iniciar Sesión</button></a>
                        <a href="../index.php"><button type="button" class="btn btn-outline-dark espacio regi">Registrarse</button></a>';
                    }
                    ?>


                </div>
            </div>
        </div>
        </div>
    </nav>
    

    

    <!-- Modal para la barra de búsqueda -->
    <div class="modal fade" id="busquedaModal" tabindex="-1" aria-labelledby="busquedaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busquedaModalLabel">Buscar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido de la barra de búsqueda -->
                    <form class="d-flex mx-2 busqueda_modal" role="search">
                        <div class="input-group">
                            <input class="form-control busqueda_input2 bus" type="search" placeholder="Busca cualquier cosa" aria-label="Search">
                            <button class="btn btn-outline-secondary bonton_icono bus2" type="submit">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                        <button class="btn btn-outline-secondary voz" type="button" id="micButton2">
                            <i class="material-icons">mic</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        const micButton = document.querySelector('#micButton');
        const busquedaInput = document.querySelector('.busqueda_input');

        micButton.addEventListener('click', function() {
            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'es-ES';
            recognition.interimResults = true;
            recognition.start();
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                busquedaInput.value = transcript;
            }
        });

        const micButton2 = document.querySelector('#micButton2');
        const busquedaInput2 = document.querySelector('.busqueda_input2');

        micButton2.addEventListener('click', function() {
            const recognition2 = new webkitSpeechRecognition();
            recognition2.lang = 'es-ES';
            recognition2.interimResults = true;
            recognition2.start();
            recognition2.onresult = function(event) {
                const transcript2 = event.results[0][0].transcript;
                busquedaInput2.value = transcript2; // Aquí se debe usar busquedaInput2
            }
        });
    </script>
    <script>
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scroll hacia abajo
                navbar.classList.add('hidden');
            } else {
                // Scroll hacia arriba
                navbar.classList.remove('hidden');
            }

            lastScrollTop = scrollTop;
        });
    </script>