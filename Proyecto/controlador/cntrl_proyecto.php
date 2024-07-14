<?php

require_once BASE_PATH . "/model/cls_proyecto.php";


$objCliente = new cls_Cliente();

$nom_cliente = "";
$rif_id = "";
$direccion = "";
$telefono = "";
$activo = "";


if (isset($_POST['guardar'])) {

    $objCliente->set_nom_cliente($_POST['nom_cliente']);
    $objCliente->set_rif_id($_POST['rif_id']);
    $objCliente->set_direccion($_POST['direccion']);
    $objCliente->set_telefono($_POST['telefono']);
    $objCliente->set_activo(1);


    $result = $objCliente->incluir();

    if ($result == 1) {
        echo "<script>alert('Registrado con éxito')</script>";
    }
}
if (isset($_POST['buscar'])) {
    $rif_id = $_POST['rif'];

    if ($objCliente->buscar($rif_id)) {
        $nom_cliente = $objCliente->get_nom_cliente();
        $rif_id = $objCliente->get_rif_id();
        $direccion = $objCliente->get_direccion();
        $telefono = $objCliente->get_telefono();
    } else {

        echo "<script>alert('No se encontraron los datos')</script>";
    }
}

if (isset($_POST['modificar'])) {

    $objCliente->set_nom_cliente($_POST['nom_cliente']);
    $objCliente->set_rif_id($_POST['rif_id']);
    $objCliente->set_direccion($_POST['direccion']);
    $objCliente->set_telefono($_POST['telefono']);




    if ($objCliente->modificar()) {
        echo "<script>alert('Registro Modficado con éxito')</script>";
    } else {
        echo "<script>alert('No se pudo Modificar')</script>";
    }
}

if (isset($_POST['eliminar'])) {

    $objCliente->set_nom_cliente($_POST['nom_cliente']);
    $objCliente->set_rif_id($_POST['rif_id']);
    $objCliente->set_direccion($_POST['direccion']);
    $objCliente->set_telefono($_POST['telefono']);

    if ($objCliente->eliminar()) {
        echo "<script>alert('Registro Eliminado con éxito')</script>";
    } else {
        echo "<script>alert('No se pudo Eliminar')</script>";
    }
}
if (isset($_POST['salir'])) {
    $objCliente->cerrar_conexion();
    if ($objCliente->cerrar_conexion() == null) {
        echo "<script>alert('Cerrada la Conexión')</script>";
    }
}
