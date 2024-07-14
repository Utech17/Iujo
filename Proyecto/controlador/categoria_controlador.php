<?php
require_once("../modelo/CCategoria.php");

$objCategoria = new Categoria();

// Listar todas las categorías
$data = $objCategoria->buscarTodos(); 

// Incluir una nueva categoría
if (isset($_POST['Enviar'])) {
    if ( isset($_POST['Nombre'])) {
        $objCategoria->setNombre($_POST['Nombre']);
        $resultado = $objCategoria->agregarCategoria();
        
        if ($resultado == 1) {
            echo "<script>alert('Categoría agregada con éxito');location.href='../vista/categoria_vista.php';</script>";
        } else {
            echo "<script>alert('Error al agregar categoría');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para agregar la categoría');</script>";
    }
}

// Actualizar una categoría
if (isset($_POST['editarId'])) {
    if (isset($_POST['ID_Categoria']) && isset($_POST['editarNombre']) && isset($_POST['editarEstado'])) {
        $objCategoria->setID_Categoria($_POST['ID_Categoria']);
        $objCategoria->setNombre($_POST['editarNombre']);
        $objCategoria->setEstado($_POST['editarEstado']);
        $resultado = $objCategoria->actualizarCategoria();
        
        if ($resultado) {
            echo "<script>alert('Categoría actualizada con éxito');location.href='../vista/categoria_vista.php';</script>";
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
        echo "<script>alert('Categoría eliminada con éxito');location.href='../vista/categoria_vista.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar categoría');</script>";
    }
}

require_once("../vista/categoria_vista.php");
?>
