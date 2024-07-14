<?php
// Llamada al modelo de usuarios
require_once("modelo/CUsuario.php");
$objUsuario = new Usuario();

// Iniciar sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Si se envió el formulario de inicio de sesión
if (isset($_POST['iniciar_sesion'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    
    // Función que verifica si el usuario y clave existen
    if ($objUsuario->autenticarUsuario($usuario, $clave)) {
        $_SESSION['id_usuario'] = $objUsuario->get_idusuario();
        // Verificar roles permitidos
        if ($_SESSION['id_usuario'] == 1 || $_SESSION['id_usuario'] == 2) {
            header("Location: vista/inicio.php");
            exit;
        }
    } else {
        // Mostrar mensaje de error si la autenticación falla
        echo "<script>alert('Usuario o contraseña incorrectos, vuelva a intentarlo')</script>";
    }
}
?>