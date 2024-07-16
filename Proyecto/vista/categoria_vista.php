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
            <h1> <a href="proyecto_controlador.php"><?php echo $proyecto['nombre'] ?></a> > Categorías</h1>
        </div>
    </div>
    <div class="contenedor-categoria px-6 pt-5">
        <div id="tabla_div">
            <a href="#" class="modal_abrir btn btn-primary" onClick="agregarCategoria();">Agregar categoría</a>
            <table id="tabla" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Nombre</th>
                        <th>Presupuesto</th>
                        <th>Monto Gastado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data) && is_array($data)) {
                        foreach ($data as $row) {
                            if (is_array($row)) {
                                $row['monto_presupuesto'] = 0.00; if( isset( $dataPresupuesto[$row['ID_Categoria']] )) $row['monto_presupuesto'] = array_sum( $dataPresupuesto[$row['ID_Categoria']] );

                                echo "<tr>";
                                $estado = ($row['Estado'] == 1) ? 'Activo' : 'Inactivo';
                                echo "<td>" . htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>" . htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>". $row['monto_presupuesto'] ."</td>";
                                echo "<td>0.00</td>";
                                echo "<td>
                                        <a href='../controlador/item_controlador.php?idCategoria=".$row['ID_Categoria']."&idProyecto=".$idProyecto."' class='btn-azul'><img src='../vista/img/ojo.png' alt='ojo'></a>
                                        <a onClick='buscarCategoria(this)' class='btn-azul' data-id='".$row['ID_Categoria']."' data-nombre='".$row['Nombre']."' data-estado='".$row['Estado']."'><img src='../vista/img/editar.png' alt='editar'></a>
                                        <a href='?eliminarId=".$row['ID_Categoria']."&idProyecto=".$idProyecto."' class='btn-rojo'><img src='../vista/img/eliminar.png' alt='eliminar'></a>
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
    <section id="modalCategoria" class="modal_section">
        <div class="modal__contenedor">
            <form id="categoriaForm" action="" method="POST">
                <input type="hidden" id="categoriaId" name="categoriaId">
                <input type="hidden" id="proyectoId" name="proyectoId" value="<?php echo $idProyecto ?>">
                <center>
                    <div class="card-header ">
                        <h3>Datos de Categoria</h3>
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
    <script src="../vista/js/modal_categoria.js"></script>
</body>
</html>