<?php
// Llamada al modelo de usuarios
require_once("modelo/CUsuario.php");
$objUsuario = new Usuario();

// Si hacen clic en botón de inicio de sesión
if( isset($_POST['iniciar_sesion']) ){
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    // Función que verifica si el usuario y clave existen    
    if($objUsuario->autenticarUsuario( $usuario, $clave )){
        $_SESSION['ID_Usuario'] = $objUsuario->get_ID_Usuario(); // Corregido aquí
        if ($_SESSION['ID_Usuario'] == 1 || $_SESSION['ID_Usuario'] == 2) {
            header("Location: vista/inicio.php");
            exit; // Asegúrate de terminar la ejecución después de redirigir
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos, vuelva a intentarlo')</script>";
    }
}
?>