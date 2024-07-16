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
    <title>Item</title>
</head>

<body>
    <?php imprimirTopBar($nombreUsuario); ?>
    <div class="contenedor">
        <div class="barra-lateral">
            <?php imprimirBarraLateral(); ?>
        </div>

        <div class="contenido">
            <h1>Item</h1>
        </div>
    </div>
    <div class="contenedor-categoria px-6 pt-5">
        <div id="tabla_div">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#" class="modal_abrir btn btn-primary"> <i class="fa-solid fa-plus"></i> Agregar Item</a>
                </div>
                <table id="tabla" class="table table-striped" style="width:100%">
                    <thead>
                        <th>Estado</th>
                        <th>Item</th>
                        <th>Acciones</th>
                        <th>Presupuesto</th>
                        <th>Monto Gastado</th>
                        <th>Acciones</th>
                        </tr>
                    <tbody>
                        <?php
                        if (isset($data) && is_array($data)) {
                            foreach ($data as $row) {
                                // Aquí debes agregar una condición para verificar si la categoría de la fila es la misma que la de la URL
                                if ($row['ID_Categoria'] == $_GET['id']) {
                                    echo "<tr>";
                                    echo "<td>" . ($row['estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>
                                           
                                            <button class='editaritem btn-azul' data-id='" . $row['id_item'] . "' data-nombre='" . $row['nombre'] . "' data-estado='" . $row['estado'] . "'>
                                                <img src='../vista/img/editar.png' alt='editar'>
                                            </button> 
                                            | 
                                            <a href='?eliminarId=" . $row['id_item'] . "'>
                                                <button class='btn-rojo'>
                                                    <img src='../vista/img/eliminar.png' alt='eliminar'>
                                                </button>
                                            </a>
                                        </td>";
                                    echo "</tr>";
                                }
                            }
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
    </div>

    <section class="modal_section">
        <div class="modal__contenedor">
            <form id="itemForm" action="" method="POST" target="_self" onsubmit="return confirmacion()">
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
                <div class="modal__botones-contenedor">
                    <input type="submit" value="Agregar" name="Enviar">
                    <input type="button" value="Cancelar" class=" modal__cerrar finalizar">
                </div>
            </form>
        </div>
    </section>

    <section class="modal_section modal_section_editar">
        <div class="modal__contenedor">
            <form id="formEditarCategoria" action="" method="POST">
                <input type="hidden" id="editarId" name="editarId">
                <div class="form-group">
                    <label for="editarEstado">Estado</label>
                    <select class="form-control" id="editarEstado" name="editarEstado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editarNombre">Nombre</label>
                    <input type="text" class="form-control" id="editarNombre" name="editarNombre">
                </div>

                <div class="modal__botones-contenedor">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary">
                    <input type="button" value="Cancelar" class="modal__cerrar finalizarEditar btn btn-secondary">
                </div>
            </form>
        </div>
    </section>

    <section class="modal_section modal_section_editar">
        <div class="modal__contenedor">
            <form id="formEditarCategoria" action="" method="POST">
                <input type="hidden" id="editarId" name="editarId">
                <div class="form-group">
                    <label for="editarEstado">Estado</label>
                    <select class="form-control" id="editarEstado" name="editarEstado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editarNombre">Nombre</label>
                    <input type="text" class="form-control" id="editarNombre" name="editarNombre">
                </div>

                <div class="modal__botones-contenedor">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary">
                    <input type="button" value="Cancelar" class="modal__cerrar finalizarEditar btn btn-secondary">
                </div>
            </form>
        </div>
    </section>

    <section class="modal_section">
        <div class="modal__contenedor">
            <form id="presupuestoForm" action="" method="POST">
                <center>
                    <div class="card-header ">
                        <h3>Agregar presupuesto </h3>
                    </div>
                </center>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="text" id="cantidad" name="cantidad" class="form-control form-control-sm" required value="">
                </div>
                <div class="form-group">
                    <label for="monto_presupuesto>Monto/label>
                    <input type=" text" id="monto_presupuesto" name="monto_presupuesto" class="form-control form-control-sm" value="">
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
            <form id="formEditarPresupuesto" action="" method="POST">
                <input type="hidden" id="editarId" name="editarId">

                <div class="form-group">
                    <label for="editarcantidad">Cantidad</label>
                    <input type="text" class="form-control" id="editarcantidad" name="editarcantidad">
                </div>
                <div class="form-group">
                    <label for="editarmonto_presupuesto">Monto</label>
                    <input type="text" class="form-control" id="editarmonto_presupuesto" name="editarmonto_presupuesto">
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
    <script src="../vista/js/modal_item.js"></script>
    <script src="../vista/js/modal_presupuesto.js"></script>

</body>

</html>