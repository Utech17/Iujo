<?php
	require_once('controlador/usuario_controlador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="vista/css/estilologin.css">
</head>
<body>
<div class="container">
    <div class="login-section">
        <div class="logo">
            <img src="vista/img/logo.png" alt="SAE Asist Escolar Logo">
        </div>
        <h1>Inicia sesión en tu Cuenta</h1>
        <form action="" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión" name="iniciar_sesion">
            </div>
        </form>
    </div>
    <div class="info-section">
        <h2>¡Optimiza tus procesos y Ahorra Tiempo!</h2>
        <img src="path_to_dashboard_image.jpg" alt="Dashboard">
        <p>Gestiona <strong>Control de Gastos</strong><br>Crea <strong>Estructura de Costos</strong></p>
    </div>
</div>
</body>
</html>