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
<table id="subtabla" class="table table-striped" style="width:100%">
        <thead>
                            <th>Seleccionar</th>
                            <th>Nombre</th>
                        </tr>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
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
          
    <form id="itemForm" action="" method="POST" target="_self" onsubmit="return confirmacion()"> <br>
                <div id="f1" class="row col-md-4">
                    <div class="col-md-12">
                        <label for=id_cliente>Codigo de cliente</label>
                        <input type="text" id="cliente_codigo_input" name="cliente_codigo_input" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for=fecha_salida>Fecha</label>
                        <input type="date" id="fecha_s" name="fecha_s" readonly class="form-control form-control-sm">
                    </div>
                    <div class="col-md-12 aqui"> <br>
                        <label for=titulo>Producto</label>
                        <a href="#" class="btn btn-info modal_abrir2">+</a>
                        <div class="lista_productos"></div>
                        <input type="hidden" id="id_producto" name="id_producto">
                        <input type="hidden" id="cant_salida" name="cant_salida">
                        
                    </div>
                
                    
                    <div class="col-md-12"><br>
                        <center>
                        <div id="botones">
                            
                            <input type="submit" value="Enviar" name="Enviar" class="btn btn-info">
                            <input type="submit" value="Limpiar" name="Limpiar" onclick="Limpiar();" id=limpiar  class="btn btn-info">
                        </div>
                        </center>
                    </div>
				</div>
                </form>

    <div class="modal__botones-contenedor">
                    <input type="submit" for value="Guardar" class="modal__agregar finalizar" id="modal_cliente">
                    <input type="button" value="Cancelar" class=" modal__cerrar finalizar">
                </div>
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