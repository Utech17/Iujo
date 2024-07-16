<?php
require_once("../modelo/proyecto_modelo.php");

$objProyecto = new Proyecto();
$data = $objProyecto->buscarTodos();
$dataAux = $objProyecto->buscarPresupuesto();
$dataPresupuesto = array(); foreach($dataAux as $c ){ $dataPresupuesto[ $c['id_proyecto'] ][] = $c['monto_presupuesto']; }
// Llamar controlador con funciones de diseño, para no repetir el mismo código
require_once("vista_controlador.php");

// Agregar/Modificar Proyecto
if (isset($_POST['Enviar'])) {
    if(isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['descripcion'])) {
        $idProyecto = $_POST['proyectoId'];
        $objProyecto->setID_Proyecto($idProyecto);
        $objProyecto->set_Estado($_POST['estado']);
        $objProyecto->set_Nombre($_POST['nombre']);
        $objProyecto->set_Descripcion($_POST['descripcion']);
        if( $idProyecto == 0 )
            $resultado = $objProyecto->agregarProyecto();
        else if( $idProyecto > 0 )
            $resultado = $objProyecto->actualizarProyecto();

        if( $idProyecto == 0 ){
            if( $resultado == 1 )
                echo "<script>alert('Proyecto agregada con éxito'); location.href='../controlador/proyecto_controlador.php';</script>";
            else
                echo "<script>alert('Error al agregar proyecto');</script>";
        } else if( $idProyecto > 0 ){
            if( $resultado == 1 )
                echo "<script>alert('Proyecto modificada con éxito'); location.href='../controlador/proyecto_controlador.php';</script>";
            else
                echo "<script>alert('Error al modificar proyecto');</script>";
        }
    } else
        echo "<script>alert('Faltan datos para agregar la proyecto');</script>";
}

// Eliminar una Proyecto
if (isset($_GET['eliminarId'])) {
    $objProyecto->setID_Proyecto($_GET['eliminarId']);
    $resultado = $objProyecto->eliminarProyecto();

    if( $resultado )
        echo "<script>alert('Proyecto eliminado con éxito'); location.href='../controlador/proyecto_controlador.php';</script>";
    else
        echo "<script>alert('Error al eliminar proyecto');</script>";
}

require_once("../vista/proyecto_vista.php");
?>