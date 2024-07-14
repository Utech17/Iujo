<?php

require_once BASE_PATH . "/model/cls_proyecto.php";


$objCliente = new cls_proyecto();

$ID_Proyecto = "";
$Nombre = "";
$Descripción = "";
$Estado = "";


if (isset($_POST['guardar'])) {

    $objCliente->set_ID_Proyecto($_POST['ID_Proyecto']);
    $objCliente->set_Nombre($_POST['Nombre']);
    $objCliente->set_Descripción($_POST['Descripción']);
    $objCliente->set_Estado($_POST['Estado']);

    $result = $objCliente->incluir();

    if ($result == 1) {
        echo "<script>alert('Registrado con éxito')</script>";
    }
}
if (isset($_POST['buscar'])) {
    $Nombre = $_POST['rif'];

    if ($objCliente->buscar($Nombre)) {
        $ID_Proyecto = $objCliente->get_ID_Proyecto();
        $Nombre = $objCliente->get_Nombre();
        $Descripción = $objCliente->get_Descripción();
        $Estado = $objCliente->get_Estado();
    } else {

        echo "<script>alert('No se encontraron los datos')</script>";
    }
}

if (isset($_POST['modificar'])) {

    $objCliente->set_ID_Proyecto($_POST['ID_Proyecto']);
    $objCliente->set_Nombre($_POST['Nombre']);
    $objCliente->set_Descripción($_POST['Descripción']);
    $objCliente->set_Estado($_POST['Estado']);




    if ($objCliente->modificar()) {
        echo "<script>alert('Registro Modficado con éxito')</script>";
    } else {
        echo "<script>alert('No se pudo Modificar')</script>";
    }
}

if (isset($_POST['eliminar'])) {

    $objCliente->set_ID_Proyecto($_POST['ID_Proyecto']);
    $objCliente->set_Nombre($_POST['Nombre']);
    $objCliente->set_Descripción($_POST['Descripción']);
    $objCliente->set_Estado($_POST['Estado']);

    if ($objCliente->eliminar()) {
        echo "<script>alert('Registro Eliminado con éxito')</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar')</script>";
    }
}
