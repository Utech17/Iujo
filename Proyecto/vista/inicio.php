<?php
require_once("../controlador/vista_controlador.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SAE Asist Escolar</title>
    <link rel="stylesheet" href="css/estilosinicio.css">
</head>
<body>
    <?php imprimirTopBar($nombreUsuario); ?>

    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral() ?>
        </div>
    </div>
</body>
</html>
