<?php
    require_once("../modelo/item_modelo.php");
    require_once("../modelo/categoria_modelo.php");
    require_once("vista_controlador.php");
    //require_once("presupuesto_controlador.php");


    $objItem = new ItemModelo();
    $objCategoria = new Categoria();
    
    $item_conexion = new Conexion();
    $categoria_conexion = new Conexion();
    $conexion = $item_conexion->conectar();
    $conexion2 = $categoria_conexion->conectar();

    $consulta = "SELECT * FROM item";
    $consulta2 = "SELECT * FROM categoria";
    $resultado = $conexion->prepare($consulta);
    $resultado2 = $conexion2->prepare($consulta2);
    $resultado->execute();
    $resultado2->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

    // maikel aqui recibes el id de la categoria recuerda que solo debes mostrar, agregar y 
    // editar segun la categoria que se te esta enviando, puedes revisar mi controlador para que te guies
    

    if (isset($_GET['id'])) {
        $_SESSION['idcategoria'] = $_GET['id'];
        $_SESSION['idProyecto'] = $_GET['idProyecto'];
    }
    
    $idcategoria = isset($_SESSION['idcategoria']) ? $_SESSION['idcategoria'] : null;
    $idProyecto = isset($_SESSION['idProyecto']) ? $_SESSION['idProyecto'] : null;








    if(isset($_POST['Enviar'])){
        echo "<script>console.log('Conectado')</script>";
    
        $objItem->set_idcategoria($idcategoria);
        $objItem->set_nombre($_POST['nombre_item_input']);
        $objItem->set_estado($_POST['estado']);
        echo "<script>console.log('Conectado2')</script>";
        
        $result = $objItem->incluir();
    
        if ($result == 1) {
            $idItem = $objItem->get_iditem(); // Obtén el id del item recién creado
            echo "<script>alert('Item agregado con éxito');location.href='../controlador/item_controlador.php?id=$idcategoria&idProyecto=$idProyecto';</script>";
        } else {
            echo "<script>alert('Error al agregar item');</script>";
        }
    } 
    
    if (isset($_GET['eliminarId'])) {
        $idItem = $_GET['eliminarId'];
        echo "<script>console.log('$idItem')</script>";
        $objItem->set_iditem($idItem);
        
        if($objItem->eliminar()){
            echo "<script>alert('Registro Eliminado con éxito');location.href='../controlador/item_controlador.php?id=$idcategoria&idProyecto=$idProyecto'; </script>";
            
        } else {
            echo "<script>alert('No se pudo Eliminar')</script>";
        }
    }
    
    // Actualizar un item
    if (isset($_POST['editarId'])) {
        if (isset($_POST['editarNombre']) && isset($_POST['editarEstado'])) {
            $idItem = $_POST['editarId'];
            $objItem->set_iditem($idItem); // Asegúrate de utilizar editarId aquí
            $objItem->set_nombre($_POST['editarNombre']);
            $objItem->set_estado($_POST['editarEstado']);
            
            $resultado = $objItem->modificar();
            
            if ($resultado) {
                echo "<script>alert('item actualizado con éxito');location.href='../controlador/item_controlador.php?id=$idcategoria&idProyecto=$idProyecto';</script>";
            } else {
                echo "<script>alert('Error al actualizar item');</script>";
            }
        } else {
            echo "<script>alert('Faltan datos para actualizar el item');</script>";
        }
    }

    
    /*if(isset($_POST['Enviar'])){
        echo "<script>console.log('Conectado')</script>";

        $objItem->set_idcliente($_POST['cliente_codigo_input']);
        $objItem->set_idproducto($_POST['id_producto']);
        $objItem->set_idusuario($id_usuario);
        $objItem->set_cantsalida($_POST['cant_salida']);
        $objItem->set_fechasalida($_POST['fecha_s']);
        echo "<script>console.log('Conectado2')</script>";
        
        $result=$objItem->agregar();
        if ($result == 1){
            // Actualizar la cantidad disponible del producto
            $id_producto = $_POST['id_producto'];
            $cant_salida = $_POST['cant_salida'];
            $actualizar_consulta = "UPDATE producto SET cantidad_disp = cantidad_disp - :cant_salida WHERE id_producto = :id_producto";
            $actualizar_stmt = $conexion->prepare($actualizar_consulta);
            $actualizar_stmt->bindValue(':cant_salida', $cant_salida, PDO::PARAM_INT);
            $actualizar_stmt->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
            $actualizar_result = $actualizar_stmt->execute();
            if ($actualizar_result){
                echo "<script>alert('Registrado y actualizado')</script>";
            } else {
                echo "<script>alert('Error, al actualizar la cantidad del producto')</script>";
            }
        } else {
            echo "<script>alert('Error, al realizar registro, vuelva a intentarlo')</script>";
        }
    }

    if (isset($_GET['eliminarId'])){
			
        $objItem->set_codigosalida($_GET['eliminarId']);
    
        if($objItem->eliminar()){
            echo "<script>alert('Registro Eliminado con éxito');location.href='transacciones_controlador.php'; </script>";
            
        } else {
            echo "<script>alert('No se pudo Eliminar')</script>";
        }
    }*/

    require_once("../vista/item_vista.php");
?>