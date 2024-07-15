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
            <h1>Categoría</h1>
        </div>
    </div>
        <div class="contenedor-categoria px-6 pt-5">
            <div id="tabla_div">
                <a href="#" class="modal_abrir btn btn-primary">Agregar categoría</a>
                <table id="tabla" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && is_array($data)) {
                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_Categoria'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                $estado = ($row['Estado'] == 1) ? 'Activo' : 'Inactivo';
                                echo "<td>" . $estado . "</td>";
                                echo "<td>
                                        <button class='editarCategoria btn-azul' data-id='" . $row['ID_Categoria'] . "' data-nombre='" . $row['Nombre'] . "' data-estado='" . $row['Estado'] . "'>
                                            <img src='../vista/img/editar.png' alt='editar'>
                                        </button> 
                                        | 
                                        <a href='?eliminarId=" . $row['ID_Categoria'] . "'>
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
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    
        <section class="modal_section">
            <div class="modal__contenedor">
                <form id="categoriaForm" action="" method="POST">
                    <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input type="text" id="Nombre" name="Nombre" class="form-control form-control-sm">
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
    </div>
    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal_categoria.js"></script>
</body>
</html>