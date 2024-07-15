<?php
require_once("../modelo/gastos_modelo.php");
require_once("../modelo/categoria_modelo.php");

$objGastos = new Gastos();
$objCategoria = new Categoria();

// Listar todos los gastos
$data = $objGastos->buscarTodos(); 

// Obtener listas de proyectos y categorías

$lista_categorias = $objGastos->obtenerListaCategorias();

// Incluir un nuevo gasto
if (isset($_POST['Guardar'])) {
    if (isset($_POST['ID_Proyecto'], $_POST['ID_Item'], $_POST['Fecha'], $_POST['Monto_Gasto'], $_POST['Comprobante'], $_POST['Observacion'])) {
        $objGastos->setID_Proyecto($_POST['ID_Proyecto']);
        $objGastos->setID_Item($_POST['ID_Item']);
        $objGastos->setFecha($_POST['Fecha']);
        $objGastos->setMonto_Gasto($_POST['Monto_Gasto']);
        $objGastos->setComprobante($_POST['Comprobante']);
        $objGastos->setObservacion($_POST['Observacion']);
        $resultado = $objGastos->agregarGasto();
        
        if ($resultado) {
            echo "<script>alert('Gasto agregado con éxito');location.href='../vista/Gastos_vista.php';</script>";
        } else {
            echo "<script>alert('Error al agregar gasto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para agregar el gasto');</script>";
    }
}

// Actualizar un gasto
if (isset($_POST['editarId'])) {
    if (isset($_POST['editarID_Proyecto'], $_POST['editarID_Item'], $_POST['editarID_Usuario'], $_POST['editarFecha'], $_POST['editarMonto_Gasto'], $_POST['editarComprobante'], $_POST['editarObservacion'])) {
        $objGastos->setID_Gasto($_POST['editarId']); 
        $objGastos->setID_Proyecto($_POST['editarID_Proyecto']);
        $objGastos->setID_Item($_POST['editarID_Item']);
        $objGastos->setID_Usuario($_POST['editarID_Usuario']);
        $objGastos->setFecha($_POST['editarFecha']);
        $objGastos->setMonto_Gasto($_POST['editarMonto_Gasto']);
        $objGastos->setComprobante($_POST['editarComprobante']);
        $objGastos->setObservacion($_POST['editarObservacion']);
        
        $resultado = $objGastos->actualizarGasto();
        
        if ($resultado) {
            echo "<script>alert('Gasto actualizado con éxito');location.href='../vista/Gastos_vista.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar gasto');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos para actualizar el gasto');</script>";
    }
}

// Eliminar un gasto
if (isset($_GET['eliminarId'])) {
    $objGastos->setID_Gasto($_GET['eliminarId']);
    $resultado = $objGastos->eliminarGasto();
    
    if ($resultado) {
        echo "<script>alert('Gasto eliminado con éxito');location.href='../vista/Gastos_vista.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar gasto');</script>";
    }
}

// Manejar la solicitud AJAX para filtrar por rango de fechas
if (isset($_GET['start_date'], $_GET['end_date'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    // Aquí llamamos a una función del modelo para buscar gastos por rango de fechas
    $data = $objGastos->buscarGastosPorFecha($startDate, $endDate);

    // Convertir los resultados a JSON y enviarlos de vuelta a la vista
    echo json_encode($data);
    exit;
}

require_once("vista_controlador.php");
require_once("../vista/Gastos_vista.php");
?>