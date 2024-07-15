<?php
require_once("../modelo/proyecto_modelo.php");

$objProyecto = new Proyecto();

$data = $objProyecto->buscarTodos();

// Llamar controlador con funciones de diseño, para no repetir el mismo código
require_once("vista_controlador.php");

if (isset($_POST['Enviar'])) {
    if (isset($_POST['Nombre'])) {
        $objProyecto->set_Nombre($_POST['Nombre']);
        $objProyecto->set_Descripcion($_POST['Descripcion']);
        $resultado = $objProyecto->agregarProyecto();

        if ($resultado == 1) {
            echo "<script>alert('Proyecto agregada con éxito');location.href='../controlador/Proyecto_controlador.php';</script>";
        } else {
            echo "<script>alert('Error al agregar proyecto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para agregar el proyecto');</script>";
    }
}

// Actualizar
if (isset($_POST['editarId'])) {
    if (isset($_POST['editarNombre']) && isset($_POST['editarEstado'])) {
        $objProyecto->set_ID_Proyecto($_POST['editarId']); // Asegúrate de utilizar editarId aquí
        $objProyecto->set_Nombre($_POST['editarNombre']);
        $objProyecto->set_Descripcion($_POST['editarDescripcion']);
        $objProyecto->set_Estado($_POST['editarEstado']);

        $resultado = $objProyecto->actualizarProyecto();

        if ($resultado) {
            echo "<script>alert('Proyecto actualizada con éxito');location.href='../controlador/Proyecto_controlador.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar proyecto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para actualizar el proyecto');</script>";
    }
}

if (isset($_GET['eliminarId'])) {
    $objProyecto->setID_Proyecto($_GET['eliminarId']);
    $resultado = $objProyecto->eliminarProyecto();

    if ($resultado) {
        echo "<script>alert('Proyecto eliminado con éxito');location.href='../controlador/Proyecto_controlador.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar proyecto');</script>";
    }
}

require_once("../vista/proyecto_vista.php");
?>