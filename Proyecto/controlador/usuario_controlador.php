<?php
require_once('modelo/usuario_modelo.php');

if (isset($_POST['iniciar_sesion'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    
    $objUsuario = new Usuario();
    if ($objUsuario->autenticarUsuario($usuario, $clave)) {
        // Iniciar sesión
        session_start();
        $_SESSION['usuario'] = $objUsuario->get_Usuario();
        $_SESSION['nombre'] = $objUsuario->get_Nombre();
        $_SESSION['apellido'] = $objUsuario->get_Apellido();

        // Redirigir a la página de inicio
        header('Location: vista/inicio.php');
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }
}
?>