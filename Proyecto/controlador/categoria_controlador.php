<?php
require_once("../modelo/categoria_modelo.php");

$objCategoria = new Categoria();

// Verificar si se ha pasado un ID de proyecto
$proyectoExiste = false;
if (isset($_GET['idProyecto'])) {
    $idProyecto = $_GET['idProyecto'];
    $objCategoria->setID_Proyecto( $idProyecto );
    $proyecto = $objCategoria->buscarProyectoNombreId();
    if( count( $proyecto) > 0 ) $proyectoExiste = true;
}
if( !$proyectoExiste )
    echo "<script>alert('Proyecto no válido'); location.href='../controlador/proyecto_controlador.php';</script>";

// Listar todas las categorías de ese proyecto
$data = $objCategoria->buscarCategoriaPorIDProyecto($idProyecto);
$dataAux = $objCategoria->buscarPresupuestoPorIDProyecto();
$dataPresupuesto = array(); foreach($dataAux as $c ){ $dataPresupuesto[ $c['ID_Categoria'] ][] = $c['monto_presupuesto']; }

// Llamar controlador con funciones de diseño, para no repetir el mismo código
require_once("vista_controlador.php");

// Agregar/Modificar Categoria
if (isset($_POST['Enviar'])) {
    if(isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['categoriaId']) && $idProyecto !== null) {
        $idCategoria = $_POST['categoriaId'];
        $objCategoria->setID_Proyecto($idProyecto);
        $objCategoria->setID_Categoria($idCategoria);
        $objCategoria->setNombre($_POST['nombre']);
        $objCategoria->setEstado($_POST['estado']);
        if( $idCategoria == 0 )
            $resultado = $objCategoria->agregarCategoria();
        else if( $idCategoria > 0 )
            $resultado = $objCategoria->actualizarCategoria();

        if( $idCategoria == 0 ){
            if( $resultado == 1 )
                echo "<script>alert('Categoría agregada con éxito'); location.href='../controlador/categoria_controlador.php?idProyecto=$idProyecto';</script>";
            else
                echo "<script>alert('Error al agregar categoría');</script>";
        } else if( $idCategoria > 0 ){
            if( $resultado == 1 )
                echo "<script>alert('Categoría modificada con éxito'); location.href='../controlador/categoria_controlador.php?idProyecto=$idProyecto';</script>";
            else
                echo "<script>alert('Error al modificar categoría');</script>";
        }
    } else
        echo "<script>alert('Faltan datos para agregar la categoría');</script>";
}

// Eliminar una categoría
if (isset($_GET['eliminarId'])) {
    $objCategoria->setID_Categoria($_GET['eliminarId']);
    $resultado = $objCategoria->eliminarCategoria();

    if( $resultado )
        echo "<script>alert('Categoría eliminada con éxito'); location.href='../controlador/categoria_controlador.php?idProyecto=$idProyecto';</script>";
    else
        echo "<script>alert('Error al eliminar categoría');</script>";
}

require_once("../vista/categoria_vista.php");
?>
