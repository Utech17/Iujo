<?php
require_once("../controlador/cntrl_proyecto.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../vista/css/estilo_item.css">
    <title>Proyecto</title>
</head>

<body>
    <div class="contenedor-Proyecto px-6 pt-5">
        <div id="tabla_div">
            <a href="#" class="modal_abrir btn btn-primary">Agregar proyecto</a>
            <table id="tabla" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data) && is_array($data)) {
                        foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Proyecto'] . "</td>";
                            echo "<td>" . $row['Nombre'] . "</td>";
                            echo "<td>" . $row['Descripción'] . "</td>";
                            $estado = ($row['Estado'] == 1) ? 'Activo' : 'Inactivo';
                            echo "<td>" . $estado . "</td>";
                            echo "<td>
                                <button class='editarProyecto btn-azul' data-id='" . $row['ID_Proyecto'] . "' data-nombre='" . $row['Nombre'] . "' data-descripción='" . $row['Descripción'] . "' data-estado='" . $row['Estado'] . "'>
                                    <img src='../vista/img/editar.png' alt='editar'>
                                </button> 
                                | 
                                <a href='?eliminarId=" . $row['ID_Proyecto'] . "'>
                                    <button class='btn-rojo'>
                                        <img src='../vista/img/eliminar.png' alt='eliminar'>
                                    </button>
                                </a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos disponibles.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <section class="modal_section">
        <div class="modal__contenedor">
            <form id="ProyectoForm" action="" method="POST">
                <center>
                    <div class="card-header ">
                        <h3>Registro de Proyecto </h3>
                    </div>
                </center>
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" id="Nombre" name="Nombre" class="form-control form-control-sm" required value="">
                </div>
                <div class="form-group">
                    <label for="Descripción">Descripción</label>
                    <input type="text" id="Descripción" name="Descripción" class="form-control form-control-sm" value="">
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
            <form id="formEditarProyecto" action="" method="POST">
                <input type="hidden" id="editarId" name="editarId">
                <div class="form-group">
                    <label for="editarNombre">Nombre</label>
                    <input type="text" class="form-control" id="editarNombre" name="editarNombre">
                </div>
                <div class="form-group">
                    <label for="editarDescripción">Descripción"</label>
                    <input type="text" class="form-control" id="editarDescripción"" name=" editarDescripción"">
                </div>
                <div class="form-group">
                    <label for="editarEstado">Estado</label>
                    <select class="form-control" id="editarEstado" name="editarEstado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="modal__botones-contenedor">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary">
                    <input type="button" value="Cancelar" class="modal__cerrar finalizarEditar btn btn-secondary">
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