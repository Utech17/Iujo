<?php
require_once("../modelo/cls_proyecto.php");

$objProyecto = new cls_proyecto();

$data = $objProyecto->buscarTodos();

if (isset($_POST['Enviar'])) {

    if (isset($_POST['Nombre'])) {
        $objProyecto->set_Nombre($_POST['Nombre']);
        $objProyecto->set_Descripción($_POST['Descripción']);
        //$objProyecto->set_Estado(1);
        $resultado = $objProyecto->agregarProyecto();

        if ($resultado == 1) {
            echo "<script>alert('Proyecto agregada con éxito');location.href='../vista/Proyecto_vista.php';</script>";
        } else {
            echo "<script>alert('Error al agregar proyecto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para agregar la proyecto');</script>";
    }
}

// Actualizar
if (isset($_POST['editarId'])) {
    if (isset($_POST['editarNombre']) && isset($_POST['editarEstado'])) {
        $objProyecto->set_ID_Proyecto($_POST['editarId']); // Asegúrate de utilizar editarId aquí
        $objProyecto->set_Nombre($_POST['editarNombre']);
        $objProyecto->set_Descripción($_POST['editarDescripción']);
        $objProyecto->set_Estado($_POST['editarEstado']);

        $resultado = $objProyecto->actualizarProyecto();

        if ($resultado) {
            echo "<script>alert('Proyecto actualizada con éxito');location.href='../vista/Proyecto_vista.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar proyecto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para actualizar la proyecto');</script>";
    }
}

// Eliminar una proyecto
if (isset($_GET['eliminarId'])) {
    $objProyecto->set_ID_Proyecto($_GET['eliminarId']);
    $resultado = $objProyecto->eliminarProyecto();

    if ($resultado) {
        echo "<script>alert('Proyecto eliminada con éxito');location.href='../vista/Proyecto_vista.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar proyecto');</script>";
    }
}

require_once("../vista/proyecto_vista.php");
