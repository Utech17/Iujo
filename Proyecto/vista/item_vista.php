<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../vista/css/estilo_item.css">
    <title>Document</title>
</head>
<body>
    <div id="tabla_div">
    <a href="#" class="modal_abrir">Agregar item</a>
<table id="tabla" class="table table-striped" style="width:100%">
        <thead>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Presupuesto</th>
                            <th>Monto Gastado</th>
                            <th>Acciones</th>
                        </tr>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['estado'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td></td>"; // Columna vacía
                                echo "<td></td>"; // Columna vacía
                                echo "<td></td>"; // Columna vacía
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
        <tfoot>
            <tr>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Presupuesto</th>
                <th>Monto Gastado</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
    </div>

    <section class="modal_section">
                <div class="modal__contenedor">
                    
                <div id="subtabla_div">

                <form id="itemForm" action="" method="POST" target="_self" onsubmit="return confirmacion()"> 

                

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
    </div>
          
   <br>
                
                    <div class="col-md-12">
                        <label for=nombre_item>Nombre</label> 
                        <input type="text" id="nombre_item_input" name="nombre_item_input" class="form-control form-control-sm">
                    </div>      

    <div class="modal__botones-contenedor">
                    <input type="submit" for value="Guardar" name="Enviar" class="modal__agregar finalizar" id="modal_cliente">
                    <input type="button" value="Cancelar" class=" modal__cerrar finalizar">
                </div>
    </div>

    </form>
         </section>

    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal.js"></script>

</body>
</html>