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
			$_SESSION['id_usuario'] = $objUsuario->get_idusuario();
			if ($_SESSION['id_usuario'] == 1 || $_SESSION['id_usuario'] == 2) {
				header("Location: vista/inicio.php");
			}
		} else
			echo "<script>alert('Usuario o contraseña incorrectos, vuelva a intentarlo')</script>";
	}
?>