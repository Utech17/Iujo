<?php
// Inicia la sesión si no está iniciada aún
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../vista/css/estilosinicio.css">
    <title>Perfil de Usuario</title>
</head>
<body>
    <?php imprimirTopBar($nombreUsuario); ?>
    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral(); ?>
        </div>
    
        <div class="contenido">
            <h1>Perfil de Usuario</h1>
        </div>
    </div>

    <div class="contenedor-categoria px-6 pt-5">
        <div id="tabla_div">
            <table id="tabla" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Usuario</strong></td>
                        <td><?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nombre</strong></td>
                        <td><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Apellido</strong></td>
                        <td><?php echo htmlspecialchars($apellido, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <!-- Empty footer -->
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
</body>
</html>
