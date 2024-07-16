<?php
require_once('../modelo/usuario_modelo.php');


// Llamar controlador con funciones de diseño, para no repetir el mismo código
require_once("vista_controlador.php");

// Inicia la sesión si no está iniciada aún
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha iniciado sesión y si las variables de sesión están definidas
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Obtener los datos del usuario de la sesión
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';

require_once("../vista/usuario_vista.php");
?>