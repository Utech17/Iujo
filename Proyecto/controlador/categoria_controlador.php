<?php
require_once("../modelo/categoria_modelo.php");

$objCategoria = new Categoria();

// Inicia la sesión si no está iniciada aún
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha pasado un ID de proyecto y guardarlo en la sesión
if (isset($_GET['id'])) {
    $_SESSION['idProyecto'] = $_GET['id'];
}

$idProyecto = isset($_SESSION['idProyecto']) ? $_SESSION['idProyecto'] : null;

// Llamar controlador con funciones de diseño, para no repetir el mismo código
require_once("vista_controlador.php");

// Listar todas las categorías de ese proyecto
$data = $objCategoria->buscarCategoriaPorIDProyecto($idProyecto); 

// Incluir una nueva categoría
if (isset($_POST['Enviar'])) {
    if (isset($_POST['Nombre']) && $idProyecto !== null) {
        $objCategoria->setID_Proyecto($idProyecto); 
        $objCategoria->setNombre($_POST['Nombre']);
        $resultado = $objCategoria->agregarCategoria();
        
        if ($resultado == 1) {
            echo "<script>alert('Categoría agregada con éxito');location.href='../controlador/categoria_controlador.php?id=$idProyecto';</script>";
        } else {
            echo "<script>alert('Error al agregar categoría');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para agregar la categoría');</script>";
    }
}

// Actualizar una categoría
if (isset($_POST['editarId'], $_POST['idProyecto'])) {
    $idCategoria = $_POST['editarId'];
    $idProyecto = $_POST['idProyecto'];
    
    if (isset($_POST['editarNombre'], $_POST['editarEstado'])) {
        $nombre = $_POST['editarNombre'];
        $estado = $_POST['editarEstado'];
        
        // Setea los valores en el objeto Categoría
        $objCategoria->setID_Categoria($idCategoria);
        $objCategoria->setID_Proyecto($idProyecto);
        $objCategoria->setNombre($nombre);
        $objCategoria->setEstado($estado);
        
        $resultado = $objCategoria->actualizarCategoria();
        
        if ($resultado) {
            echo "<script>alert('Categoría actualizada con éxito');location.href='../controlador/categoria_controlador.php?id=$idProyecto';</script>";
        } else {
            echo "<script>alert('Error al actualizar categoría');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para actualizar la categoría');</script>";
    }
}

// Eliminar una categoría
if (isset($_GET['eliminarId'])) {
    $objCategoria->setID_Categoria($_GET['eliminarId']);
    $resultado = $objCategoria->eliminarCategoria();
    
    if ($resultado) {
        echo "<script>alert('Categoría eliminada con éxito');location.href='../controlador/categoria_controlador.php?id=$idProyecto';</script>";
    } else {
        echo "<script>alert('Error al eliminar categoría');</script>";
    }
}

require_once("../vista/categoria_vista.php");
?>