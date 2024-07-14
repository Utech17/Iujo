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
    <link rel="stylesheet" type="text/css" href="../vista/css/estilosinicio.css">
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
                <a href="#" class="modal_abrir btn btn-primary">Agregar Gasto</a>
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

    </div>
    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal_categoria.js"></script>
</body>
</html>