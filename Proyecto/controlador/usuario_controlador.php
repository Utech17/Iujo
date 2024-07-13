<?php
	session_start(); // Asegúrate de iniciar la sesión al principio del archivo

	// Configurar el tiempo máximo de inactividad
	define('MAX_INACTIVITY_TIME', 10 * 60); // 10 minutos en segundos
	
	// Llamada al modelo de usuarios
	require_once("modelo/CUsuario.php");
	$objUsuario = new Usuario();
	
	// Verificar si ya inicio session
	if (isset($_SESSION['id_usuario'])) {
		// Verificar tiempo de inactividad
		if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > MAX_INACTIVITY_TIME) {
			session_unset();
			session_destroy();
			header("Location: index.php");
			exit();
		}
	
		$_SESSION['last_activity'] = time(); // actualizar el tiempo de última actividad
	
		if ($_SESSION['id_usuario'] == 1 || $_SESSION['id_usuario'] == 2) {
			header("Location: vista/inicio.php");
			exit();
		} else {
			session_destroy();
			header("Location: index.php");
			exit();
		}
	}
	
	// Si hacen clic en botón de inicio de sesión
	if (isset($_POST['iniciar_sesion'])) {
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];
	
		// Función que verifica si el usuario y clave existen
		if ($objUsuario->autenticarUsuario($usuario, $clave)) {
			$_SESSION['id_usuario'] = $objUsuario->get_idusuario();
			$_SESSION['last_activity'] = time(); // establecer el tiempo de última actividad
			
			if ($_SESSION['id_usuario'] == 1 || $_SESSION['id_usuario'] == 2) {
				header("Location: vista/inicio.php");
				exit();
			}
		} else {
			echo "<script>alert('Usuario o contraseña incorrectos, vuelva a intentarlo')</script>";
		}
	}
?>