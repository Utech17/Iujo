<?php
require_once("../modelo/CCategoria.php");

$objCategoria = new Categoria();

// Listar todas las categorías
$data = $objCategoria->buscarTodos(); 

// Incluir una nueva categoría
if (isset($_POST['Enviar'])) {
    $objCategoria->setID_Categoria($_POST['ID_Categoria']);
    $objCategoria->setNombre($_POST['Nombre']);
    $objCategoria->setEstado($_POST['Estado']);
    $resultado = $objCategoria->agregarCategoria();
    
    if ($resultado == 1) {
        echo "<script>alert('Categoría agregada con éxito');location.href='categoria_controlador.php';</script>";
    } else {
        echo "<script>alert('Error al agregar categoría');</script>";
    }
}

// Editar una categoría
if (isset($_GET['editarId'])) {
    $categoria = $objCategoria->buscarCategoriaPorID($_GET['editarId']);
    if ($categoria) {
        // Aquí se podría cargar un formulario con los datos de la categoría para editarlos
    }
}

// Actualizar una categoría
if (isset($_POST['Actualizar'])) {
    $objCategoria->setID_Categoria($_POST['ID_Categoria']);
    $objCategoria->setNombre($_POST['Nombre']);
    $objCategoria->setEstado($_POST['Estado']);
    $resultado = $objCategoria->actualizarCategoria();
    
    if ($resultado) {
        echo "<script>alert('Categoría actualizada con éxito');location.href='categoria_controlador.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar categoría');</script>";
    }
}

// Eliminar una categoría
if (isset($_GET['eliminarId'])) {
    $objCategoria->setID_Categoria($_GET['eliminarId']);
    $resultado = $objCategoria->eliminarCategoria();
    
    if ($resultado) {
        echo "<script>alert('Categoría eliminada con éxito');location.href='categoria_controlador.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar categoría');</script>";
    }
}

require_once("../vista/categoria_vista.php");
?>