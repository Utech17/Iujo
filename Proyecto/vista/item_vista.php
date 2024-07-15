<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" type="text/css" href="../vista/css/estilosinicio.css">
    <link rel="stylesheet" href="../vista/css/estilo_item.css">
    <title>Item</title>
</head>
<body>

<?php imprimirTopBar($nombreUsuario); ?>
    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral(); ?>
        </div>

    <div id="tabla_div">
    <a href="#" class="btn btn-info modal_abrir">Agregar item</a>
<table id="tabla" class="table table-striped" style="width:100%">
        <thead>
                            <th>Estado</th>
                            <!--<th>Categoria</th>-->
                            <th>Item</th>
                            <!--<th>Presupuesto</th>
                            <th>Monto Gastado</th>-->
                            <th>Acciones</th>
                        </tr>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . ($row['estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
                                                        /*$Nombre_categoria = '';
                            foreach ($data2 as $categoria) {
                                if ($categoria['id_categoria'] == $row['id_categoria']) {
                                    $Nombre_categoria = $categoria['nombre'];
                                    break;
                                }
                            }

                                echo "<td>" . $Nombre_categoria . "</td>";*/
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>";
    
                                
                                echo '<a href="#" class="btn btn-azul">';
        echo '<img src="../vista/img/pencil.png" alt="Modificar" width="16" height="16"></a>';
        
        echo '<a href="../controlador/item_controlador.php?eliminarId=' . $row['id_item'] . '" class="btn btn-rojo">';
echo '<img src="../vista/img/trash.png" alt="Eliminar" width="16" height="16"></a>';
                                
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
        <tfoot>
            <tr>
                <th>Estado</th>
                <!--<th>Categoria</th>-->
                <th>Item</th>
               <!-- <th>Presupuesto</th>
                <th>Monto Gastado</th>-->
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
    </div>







    <section class="modal_section">
                <div class="modal__contenedor">

                    <form id="itemForm" action="" method="POST" target="_self" onsubmit="return confirmacion()">
                    
                        <!--<div id="subtabla_div">        

                                <table id="subtabla" class="table table-striped" style="width:100%">
                                        <thead>
                                                            <th>Seleccionar</th>
                                                            <th>Nombre</th>
                                                        </tr>
                                                        <tbody>
                                                            <?php
                                                            foreach ($data2 as $row) {
                                                                echo "<tr>";
                                                                echo "<td><input type='radio' class='categoria_seleccionada' name='categoria_seleccionada' value='" . $row['id_categoria'] . "'></td>";
                                                                echo "<td>" . $row['nombre'] . "</td>";
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Nombre</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                        </div>-->
                <h2>Agregar item</h2>
                <br>
                        
                            <div class="col-md-12">

                            <p>Elegir estado:</p>
                        
                            <select class="form-control" id="estado" name="estado">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>

                            <br>

                                <label for=nombre_item>Nombre</label> 
                                <input type="text" id="nombre_item_input" name="nombre_item_input" class="form-control form-control-sm">
                            </div>

                            <input type="submit" value="Enviar" name="Enviar" class="btn btn-info">

                            <div class="modal__botones-contenedor">
                                <input type="submit" for value="Guardar" name="Guardar" class="modal__agregar finalizar" id="modal_cliente">
                                <input type="button" value="Cancelar" class=" modal__cerrar finalizar">
                            </div>

                    </form>
                </div>                                           
    </section>

    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal.js"></script>

</body>
</html>