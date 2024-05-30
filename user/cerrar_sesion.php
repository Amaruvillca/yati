<?php
session_start();
session_unset();
session_destroy();
 // Borrar las cookies
 setcookie('id_usuario', '', time() - 3600, '/');
 setcookie('tipo', '', time() - 3600, '/');
header("Location: ../index.php"); // Redirige a la página principal después de cerrar sesión
exit();
?>
