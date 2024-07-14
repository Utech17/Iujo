<?php

require_once BASE_PATH . '/controlador/cntrl_proyecto.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../vista/css/estilo_item.css">
    <title>Proyectos</title>
</head>

<body>
    <div id="tabla_div">
        <a href="#" class="modal_abrir">Agregar proyecto</a>
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
                        echo "<td>" . $row['Descrpción'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td><a href='?editarId=" . $row['ID_Proyecto'] . "'>Editar</a> | <a href='?eliminarId=" . $row['ID_Proyecto'] . "'>Eliminar</a></td>";
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
                    <th>Descrpción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <section class="modal_section">
        <div class="modal__contenedor">
            <form id="proyectoForm" action="" method="POST">
                <div id="f1" class="row col-md-4">
                    <div class="col-md-12">
                        <label for="Nombre">Nombre</label>
                        <input type="text" id="Nombre" name="Nombre" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-12">
                        <label for="Nombre">Descripción</label>
                        <input type="text" id="Descripción<" name="Descripción<" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-12"><br>
                        <center>
                            <div id="botones">
                                <input type="submit" value="Enviar" name="Enviar" class="btn btn-info">
                                <input type="reset" value="Limpiar" class="btn btn-info">
                            </div>
                        </center>
                    </div>
                </div>
            </form>

            <div class="modal__botones-contenedor">
                <input type="button" value="Guardar" class="modal__agregar finalizar">
                <input type="button" value="Cancelar" class="modal__cerrar finalizar">
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