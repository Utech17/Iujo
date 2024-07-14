<?php
// Función para imprimir la barra superior con el nombre de usuario
function imprimirTopBar($nombreUsuario) {
    ?>
    <div class="top-bar">
        <div class="user-info">
            <span><?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
    </div>
    <?php
}

// Función para imprimir la barra lateral con el menú
function imprimirBarraLateral() {
    ?>
    <div class="logo">
        <img src="../vista/img/logo.png" alt="Logo">
    </div>
    <ul class="menu">
        <li><img src="../vista/img/dashboard.png" alt="dashboard"><a href="#"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li><img src="../vista/img/gastos.png" alt="usuargastosios"><a href="#"><i class="icon-gastos"></i> Gastos</a></li>
        <li><img src="../vista/img/configuracion.png" alt="configuracion"><a href="#"><i class="icon-configuracion"></i> Configuración</a></li>
        <li><img src="../vista/img/usuarios.png" alt="usuarios"><a href="#"><i class="icon-usuarios"></i> Usuarios</a></li>
        <li><img src="../vista/img/reportes.png" alt="reportes"><a href="#"><i class="icon-reportes"></i> Reportes</a></li>
    </ul>
    <?php
}
?>