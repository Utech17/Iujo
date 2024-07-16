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
$idProyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : '0';
$idCategoria = isset($_GET['idCategoria']) ? $_GET['idCategoria'] : '0';
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
            <h1> <a href="proyecto_controlador.php"><?php echo $proyecto['nombre'] ?></a>
            > <a href="categoria_controlador.php?idProyecto=<?php echo $idProyecto ?>"><?php echo $categoria['nombre'] ?></a>
            > Categorías</h1>
        </div>
    </div>
    <div class="contenedor-categoria px-6 pt-5">
        <div id="tabla_div">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#" class="modal_abrir btn btn-primary" onClick="agregarItem();">Agregar Item</a>
                </div>
                <table id="tabla" class="table table-striped" style="width:100%">
                    <thead>
                        <th>Estado</th>
                        <!--<th>Categoria</th>-->
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Presupuesto</th>
                        <th>Monto Gastado</th>
                        <th>Acciones</th>
                    </tr>
                    <tbody>
                        <?php
                            if (isset($data) && is_array($data)) {
                                foreach ($data as $row) {
                                    $row['cantidad'] = $row['presupuesto'] = '';
                                    if( isset( $dataPresupuesto[ $row['id_item']] ) ){
                                        $aux = $dataPresupuesto[ $row['id_item']];
                                        $row['cantidad'] = $aux['cantidad'];
                                        $row['presupuesto'] = $aux['monto_presupuesto'];
                                    }
                                    echo "<tr>";
                                    echo "<td>" . ($row['estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>" . $row['cantidad'] . "</td>";
                                    echo "<td>" . $row['presupuesto'] . "</td>";
                                    echo "<td>0.00</td>";
                                    echo "<td>
                                        <a onClick='buscarItem(this)' class='btn-azul' data-id='".$row['id_item']."' data-nombre='".$row['nombre']."' data-estado='".$row['estado']."' data-cantidad='".$row['cantidad']."' data-presupuesto='".$row['presupuesto']."'><img src='../vista/img/editar.png' alt='editar'></a>
                                        <a href='?eliminarId=".$row['id_item']."&idProyecto=".$idProyecto."&idCategoria=".$idCategoria."' class='btn-rojo'><img src='../vista/img/eliminar.png' alt='eliminar'></a>
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
    </div>

    <section id="modalItem" class="modal_section">
        <div class="modal__contenedor">
            <form id="itemForm" action="" method="POST">
                <input type="hidden" id="itemId" name="itemId">
                <input type="hidden" id="categoriaId" name="categoriaId" value="<?php echo $idCategoria ?>">
                <input type="hidden" id="proyectoId" name="proyectoId" value="<?php echo $idProyecto ?>">
                <center>
                    <div class="card-header ">
                        <h3>Datos de Item</h3>
                    </div>
                </center>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="1" selected>Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="Nombre">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control form-control-sm" maxlength="5" min="0" max="99999" required>
                </div>
                <div class="form-group">
                    <label for="Nombre">Presupuesto</label>
                    <input type="text" id="presupuesto" name="presupuesto" class="form-control form-control-sm" onkeydown="allowOnlyFloat(event)" oninput="validateFloatInput(this)" required>
                </div>
                <div class="modal__botones-contenedor">
                    <input type="button" value="Cancelar" class="btn btn-secondary" onClick="cerrarModal()">
                    <input id="buttonSubmit" type="submit" name="Enviar" class="btn btn-primary">
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

</body>
</html>