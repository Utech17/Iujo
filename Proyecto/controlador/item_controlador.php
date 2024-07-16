<?php
    require_once("../modelo/item_modelo.php");
    require_once("vista_controlador.php");

    $objItem = new ItemModelo();
    // Verificar si se ha pasado un ID de proyecto
    $proyectoExiste = false;
    if (isset($_GET['idProyecto'])) {
        $idProyecto = $_GET['idProyecto'];
        $objItem->setID_Proyecto( $idProyecto );
        $proyecto = $objItem->buscarProyectoNombreId();
        if( count( $proyecto) > 0 ) $proyectoExiste = true;
    }
    if( !$proyectoExiste )
        echo "<script>alert('Proyecto no válido'); location.href='../controlador/proyecto_controlador.php';</script>";

    // Verificar si se ha pasado un ID de proyecto
    $categoriaExiste = false;
    if (isset($_GET['idCategoria'])) {
        $idCategoria = $_GET['idCategoria'];
        $objItem->setID_Categoria( $idCategoria );
        $categoria = $objItem->buscarCategoriaNombreId();
        if( count( $categoria ) > 0 ) $categoriaExiste = true;
    }
    if( !$categoriaExiste )
        echo "<script>alert('Categoría no válida'); location.href='../controlador/categoria_controlador.php?idProyecto=$idProyecto';</script>";

    // Listar todas las categorías de ese proyecto
    $data = $objItem->buscarItemPorIDCategoria($idCategoria);
    $dataAux = $objItem->buscarPresupuestoPorProyecto($idProyecto);
    $dataPresupuesto = array(); foreach($dataAux as $c ){ $dataPresupuesto[ $c['id_item'] ] = $c; }

    // Agregar/Modificar Categoria
    if (isset($_POST['Enviar'])) {
        if(isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['cantidad']) && isset($_POST['presupuesto']) && $idCategoria !== null&& $idProyecto !== null) {
            $idProyecto = $_POST['proyectoId'];
            $idCategoria = $_POST['categoriaId'];
            $idItem = $_POST['itemId'];

            $objItem->setID_Proyecto($idProyecto);
            $objItem->setID_Categoria($idCategoria);
            $objItem->setID_Item($idItem);
            $objItem->setNombre($_POST['nombre']);
            $objItem->setEstado($_POST['estado']);
            $objItem->setCantidad($_POST['cantidad']);
            $objItem->setPresupuesto($_POST['presupuesto']);
            if( $idItem == 0 )
                $resultado = $objItem->agregarItem();
            else if( $idItem > 0 )
                $resultado = $objItem->actualizarItem();

            if( $idItem == 0 ){
                if( $resultado == 1 )
                    echo "<script>alert('Item agregado con éxito'); location.href='../controlador/item_controlador.php?idProyecto=$idProyecto&idCategoria=$idCategoria';</script>";
                else
                    echo "<script>alert('Error al agregar item');</script>";
            } else if( $idItem > 0 ){
                if( $resultado == 1 )
                    echo "<script>alert('Item modificado con éxito'); location.href='../controlador/item_controlador.php?idProyecto=$idProyecto&idCategoria=$idCategoria';</script>";
                else
                    echo "<script>alert('Error al modificar item');</script>";
            }
        } else
            echo "<script>alert('Faltan datos para agregar la item');</script>";
    }

    // Eliminar una categoría
    if (isset($_GET['eliminarId'])) {
        $objItem->setID_Item($_GET['eliminarId']);
        $resultado = $objItem->eliminarItem();

        if( $resultado )
            echo "<script>alert('Item eliminado con éxito'); location.href='../controlador/item_controlador.php?idProyecto=$idProyecto&idCategoria=$idCategoria';</script>";
        else
            echo "<script>alert('Error al eliminar item');</script>";
    }

    require_once("../vista/item_vista.php");
?>