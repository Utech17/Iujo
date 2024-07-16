<?php
// Inicia la sesión si no está iniciada aún
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];
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
                        <th>Estado</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data) && is_array($data)) {
                        foreach ($data as $row) {
                            if (is_array($row)) {
                                echo "<tr>";
                                $estado = ($row['Estado'] == 1) ? 'Activo' : 'Inactivo';
                                echo "<td>" . htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>" . htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>
                                        <a href='../controlador/item_controlador.php?id=" . htmlspecialchars($row['ID_Categoria'], ENT_QUOTES, 'UTF-8') . "&idProyecto=" . htmlspecialchars($row['ID_Proyecto'], ENT_QUOTES, 'UTF-8') . "'>
                                            <button class='btn-azul'>
                                                <img src='../vista/img/ojo.png' alt='ojo'>
                                            </button>
                                        </a>
                                        | 
                                        <button class='editarCategoria btn-azul' data-id='" . htmlspecialchars($row['ID_Categoria'], ENT_QUOTES, 'UTF-8') . "' data-nombre='" . htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8') . "' data-estado='" . htmlspecialchars($row['Estado'], ENT_QUOTES, 'UTF-8') . "'>
                                            <img src='../vista/img/editar.png' alt='editar'>
                                        </button> 
                                        | 
                                        <a href='?eliminarId=" . htmlspecialchars($row['ID_Categoria'], ENT_QUOTES, 'UTF-8') . "'>
                                            <button class='btn-rojo'>
                                                <img src='../vista/img/eliminar.png' alt='eliminar'>
                                            </button>
                                        </a>
                                    </td>";
                                echo "</tr>";
                            } else {
                                echo "<tr><td colspan='3'>Dato incorrecto en la fila.</td></tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay datos disponibles.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <!-- Empty footer -->
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
                <input type="hidden" id="idProyecto" name="idProyecto" value="<?php echo htmlspecialchars($idProyecto, ENT_QUOTES, 'UTF-8'); ?>">
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
    <script src="../vista/js/jquery-3.7.1.js"></script>
    <script src="../vista/js/bootstrap.bundle.min.js"></script>
    <script src="../vista/js/dataTables.js"></script>
    <script src="../vista/js/dataTables.bootstrap5.js"></script>
    <script src="../vista/js/tableScript.js"></script>
    <script src="../vista/js/modal_categoria.js"></script>
</body>
</html>