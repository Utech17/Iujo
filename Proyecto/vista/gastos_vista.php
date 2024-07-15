<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista/css/dataTables.bootstrap5.css">
    <script src="https://kit.fontawesome.com/68b92f41c0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../vista/css/estilosinicio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>
    
    <title>Categorías</title>
</head>
<body>



<?php imprimirTopBar($nombreUsuario); ?>
    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral(); ?>
        </div>
    
        <div class="contenido">
            <h1>Gastos</h1>
        </div>
    </div>
        <div class="contenedor-categoria px-6 pt-5">
            <div id="tabla_div">
            <div class="row">
                    
                <div class="col-sm-3">
                    <input type="text" id="daterange" class="form-control">
                </div>
                <div class="col-sm-2">                 
                <select id="idcategoria" name="idcategoria" class="form-control form-control-sm">
                        <option value="0">-- Ninguna --</option>
                        <?php foreach ($lista_categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                        <?php } ?>
                    </select>
                    </div>   
                <div class="col-sm-2">                 
                <select id="idcategoria" name="idcategoria" class="form-control form-control-sm">
                        <option value="0">-- Ninguna --</option>
                        <?php foreach ($lista_categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre']; ?></option>
                        <?php } ?>
                    </select>
                    </div>               
                <div class="col-sm-2">
													<button type="button" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                                    
				</div>

                <div class="col-sm-3">
                    <a href="#" class="modal_abrir btn btn-primary"> <i class="fa-solid fa-plus"></i> Agregar Gasto</a>
                </div>
             </div>

                <table id="tabla" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Item</th>
                            <th>Monto</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && is_array($data)) {
                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['Fecha'] . "</td>";
                                echo "<td>" . $row['ID_Item'] . "</td>";
                                echo "<td>" . $row['Monto_Gasto'] . "</td>";
                                echo "<td>" . $row['ID_Categoria'] . "</td>";
                                echo "<td>
                                        <button class='editarGasto btn-azul' data-id='" . $row['ID_Gasto'] . "' data-id_proyecto='" . $row['ID_Proyecto'] . "' data-id_item='" . $row['ID_Item'] . "' data-id_usuario='" . $row['ID_Usuario'] . "' data-fecha='" . $row['Fecha'] . "' data-monto_gasto='" . $row['Monto_Gasto'] . "' data-comprobante='" . $row['Comprobante'] . "' data-observacion='" . $row['Observacion'] . "'>
                                            <img src='../vista/img/editar.png' alt='editar'>
                                        </button> 
                                        | 
                                        <a href='?eliminarId=" . $row['ID_Gasto'] . "'>
                                            <button class='btn-rojo'>
                                                <img src='../vista/img/eliminar.png' alt='eliminar'>
                                            </button>
                                        </a>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay datos disponibles.</td></tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    
        <section class="modal_section">
        <div class="modal__contenedor">
            <form id="gastoForm" action="" method="POST">
                <div class="form-group">
                    <label for="ID_Proyecto">Proyecto</label>
                    <input type="text" id="ID_Proyecto" name="ID_Proyecto" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="ID_Item">Item</label>
                    <input type="text" id="ID_Item" name="ID_Item" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="ID_Usuario">Usuario</label>
                    <input type="text" id="ID_Usuario" name="ID_Usuario" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="Fecha">Fecha</label>
                    <input type="date" id="Fecha" name="Fecha" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="Monto_Gasto">Monto</label>
                    <input type="number" id="Monto_Gasto" name="Monto_Gasto" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="Comprobante">Comprobante</label>
                    <input type="text" id="Comprobante" name="Comprobante" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="Observacion">Observación</label>
                    <input type="text" id="Observacion" name="Observacion" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="ID_Categoria">Categoría</label>
                    <input type="text" id="ID_Categoria" name="ID_Categoria" class="form-control form-control-sm">
                </div>
                <div class="modal__botones-contenedor">
                    <input type="submit" value="Enviar" name="Enviar" class="btn btn-primary">
                    <input type="reset" value="Limpiar" class="btn btn-warning">
                    <input type="button" value="Cancelar" class="modal__cerrar finalizar btn btn-secondary">
                </div>
            </form>
        </div>
    </section>

    <section class="modal_section modal_section_editar">
        <div class="modal__contenedor">
            <form id="formEditarGasto" action="" method="POST">
                <input type="hidden" id="editarId" name="editarId">
                <div class="form-group">
                    <label for="editarID_Proyecto">Proyecto</label>
                    <input type="text" class="form-control" id="editarID_Proyecto" name="editarID_Proyecto">
                </div>
                <div class="form-group">
                    <label for="editarID_Item">Item</label>
                    <input type="text" class="form-control" id="editarID_Item" name="editarID_Item">
                </div>
                <div class="form-group">
                    <label for="editarID_Usuario">Usuario</label>
                    <input type="text" class="form-control" id="editarID_Usuario" name="editarID_Usuario">
                </div>
                <div class="form-group">
                    <label for="editarFecha">Fecha</label>
                    <input type="date" class="form-control" id="editarFecha" name="editarFecha">
                </div>
                <div class="form-group">
                    <label for="editarMonto_Gasto">Monto</label>
                    <input type="number" class="form-control" id="editarMonto_Gasto" name="editarMonto_Gasto">
                </div>
                <div class="form-group">
                    <label for="editarComprobante">Comprobante</label>
                    <input type="text" class="form-control" id="editarComprobante" name="editarComprobante">
                </div>
                <div class="form-group">
                    <label for="editarObservacion">Observación</label>
                    <input type="text" class="form-control" id="editarObservacion" name="editarObservacion">
                </div>
                <div class="form-group">
                    <label for="editarID_Categoria">Categoría</label>
                    <input type="text" class="form-control" id="editarID_Categoria" name="editarID_Categoria">
                </div>
                <div class="modal__botones-contenedor">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary">
                    <input type="button" value="Cancelar" class="modal__cerrar finalizarEditar btn btn-secondary">
                </div>
            </form>
        </div>
    </section>

    <!-- Script para inicializar el selector de fechas y manejar la solicitud AJAX -->
    <script>
        $(function() {
    $('#daterange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
        filtrarDatos(startDate, endDate);
    });
});

        function filtrarDatos(startDate, endDate) {
            $.ajax({
                url: 'gastos_controlador.php', // Ruta al controlador PHP
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(data) {
                    // Actualizar la tabla con los datos filtrados
                    var tableBody = '';
                    data = JSON.parse(data);
                    data.forEach(function(item) {
                        tableBody += '<tr>';
                        tableBody += '<td>' + item.Fecha + '</td>';
                        tableBody += '<td>' + item.ID_Item + '</td>';
                        tableBody += '<td>' + item.Monto_Gasto + '</td>';
                        tableBody += '<td>' + item.ID_Categoria + '</td>';
                        tableBody += '<td>Acciones</td>';
                        tableBody += '</tr>';
                    });
                    $('#tabla tbody').html(tableBody);
                }
            });
        }
    </script>
</body>
</html>

    </div>
    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal_categoria.js"></script>
</body>
</html>