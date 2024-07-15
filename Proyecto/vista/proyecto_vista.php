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
    <title>Proyecto</title>
</head>

<body>
    <?php imprimirTopBar($nombreUsuario); ?>
    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral(); ?>
        </div>

        <div class="contenido">
            <h1>Proyecto</h1>
        </div>
    </div>
    <div class="contenedor-proyecto px-6 pt-5">
        <div id="tabla_div">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#" class="modal_abrir btn btn-primary"> <i class="fa-solid fa-plus"></i> Agregar Proyecto</a>
                </div>
                <table id="tabla" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && is_array($data)) {
                            foreach ($data as $row) {
                                echo "<tr>";
                                $estado = ($row['Estado'] == 1) ? 'Activo' : 'Inactivo';
                                echo "<td>" . $estado . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Descripcion'] . "</td>";
                                echo "<td>
                                    <a href='../controlador/categoria_controlador.php'>
                                            <button class='btn-azul'>
                                                <img src='../vista/img/ojo.png' alt='ojo'>
                                            </button>
                                    </a>
                                    | 
                                    <button class='editarProyecto btn-azul' data-id='" . $row['ID_Proyecto'] . "' data-nombre='" . $row['Nombre'] . "' data-descripcion='" . $row['Descripcion'] . "' data-estado='" . $row['Estado'] . "'>
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
                        <label for="Descripcion">Descripción</label>
                        <input type="text" id="Descripcion" name="Descripcion" class="form-control form-control-sm" value="">
                    </div>

                    <div class="modal__botones-contenedor">
                        <input type="button" value="Cancelar" class="modal__cerrar finalizar btn btn-secondary">
                        <input type="submit" value="Enviar" name="Enviar" class="btn btn-primary">
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
                        <label for="editarDescripcion">Descripción"</label>
                        <input type="text" class="form-control" id="editarDescripcion" name=" editarDescripcion">
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
        <script src="../vista/js/modal_proyecto.js"></script>
</body>

</html>