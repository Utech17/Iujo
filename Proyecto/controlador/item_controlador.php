<?php
    require_once("../modelo/item_modelo.php");
    require_once("../modelo/CCategoria.php");
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

    if(isset($_POST['Enviar'])){
        echo "<script>console.log('Conectado')</script>";

        //$objItem->set_idcategoria($_POST['categoria_seleccionada']);
        $objItem->set_nombre($_POST['nombre_item_input']);
        $objItem->set_estado($_POST['estado']);
        echo "<script>console.log('Conectado2')</script>";
        
        $result=$objItem->incluir();

        echo "<script>console.log('Conectado3')</script>";
    }

    if (isset($_GET['eliminarId'])){
			
        $objItem->set_iditem($_GET['eliminarId']);
    
        if($objItem->eliminar()){
            echo "<script>alert('Registro Eliminado con éxito');location.href='item_controlador.php'; </script>";
            
        } else {
            echo "<script>alert('No se pudo Eliminar')</script>";
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