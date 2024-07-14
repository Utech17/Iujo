<?php

function imprimirTopBar($nombreUsuario) {
    ?>
    <div class="top-bar">
        <div class="user-info">
            <img src="../vista/img/user.png" alt="usuario">
            <span><?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
    </div>
    <?php
}

function imprimirBarraLateral() {
    ?>
    <div class="barra-lateral">
        <div class="logo">
            <img src="../vista/img/logo.png" alt="Logo">
        </div>
        <ul class="menu">
            <li><img src="../vista/img/dashboard.png" alt="dashboard"><a href="#"><i class="icon-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="icon-gastos"></i> Gastos</a></li>
            <li><a href="#"><i class="icon-configuracion"></i> Configuración</a></li>
            <li><img src="../vista/img/usuarios.png" alt="usuarios"><a href="#"><i class="icon-usuarios"></i> Usuarios</a></li>
            <li><img src="../vista/img/reportes.png" alt="reportes"><a href="#"><i class="icon-reportes"></i> Reportes</a></li>
        </ul>
    </div>
    <?php
}
?>