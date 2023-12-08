<?php $menuUsuario = PermisosControlador::ctrObtenerMenuUsuario($_SESSION["s_usuario"]->id_usuario);
$permisosUsuario = PermisosControlador::ctrObtenerPermisosUsuario($_SESSION["s_usuario"]->id_usuario);
$configUsuario = PermisosControlador::ctrObtenerConfigUsuario();


$_SESSION["logo"] = $configUsuario[0]->rutalogo;
$_SESSION["institucion"] = $configUsuario[0]->institucion;
$_SESSION["permisoCrear"] = $permisosUsuario[0]->crear;
$_SESSION["permisoAprobar"] = $permisosUsuario[0]->aprobar;
$_SESSION["permisoEliminar"] = $permisosUsuario[0]->eliminar;
$_SESSION["permisoEditar"] = $permisosUsuario[0]->editar;
$_SESSION["mostrarCV"] = false;
$_SESSION["mostrarCA"] = false;



if ($_SESSION["permisoEditar"] || $_SESSION["permisoEliminar"]) {
    $_SESSION["mostrarCV"] = true;
}
if ($_SESSION["permisoAprobar"] || $_SESSION["permisoEditar"] || $_SESSION["permisoEliminar"]) {
    $_SESSION["mostrarCA"] = true;
}

?>

<head>
    <link rel="icon" href="assets/img/657232efd180a_webcamtoyfoto3.jpg">
</head>

<script>
        // Supongamos que obtienes la ruta del ícono dinámicamente de la base de datos
        var IconPath = '<?php echo $_SESSION["logo"]; ?>';
        console.log(IconPath);
        // Cambia el atributo href del ícono en la pestaña
        document.getElementById("icon_dynamic").href = IconPath;
</script>
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src=<?php echo $_SESSION["logo"]; ?> alt="AdminLTELogo" height="100" width="100">
</div>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src=<?php echo $_SESSION["logo"]; ?> alt="logo" class="brand-image" />
        <span style="font-family: 'Source Sans Pro';" class="brand-text font-weight-light"><?php echo $_SESSION["institucion"]; ?></span><br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="text-align: center;">
            <div class="info">
                <p style=" margin-top:revert; color: white;text-align: center;font-size: 18px;font-weight: 600; font-family: system-ui;">
                    Bienvenido, <?php
                                if ($_SESSION["s_usuario"]->id_usuario == 1) {
                                    echo "Administrador";
                                } else {
                                    echo $_SESSION["s_usuario"]->nombre_usuario;
                                } ?></p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul id="nav" class=" nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="white-space:nowrap;">
                <?php foreach ($menuUsuario as $menu) : ?>
                    <li class="nav-item">
                        <a id="<?php echo $menu->modulo ?>" class="nav-link setA <?php if ($menu->vista_inicio == 1) : ?>
                                                                            <?php echo 'active'; ?>
                                                                        <?php endif; ?>" <?php if (!empty($menu->vista)) : ?> onclick="if (!$(this).hasClass('active')) cargarContenido('content-wrapper', 'views/<?php echo $menu->vista; ?>')" <?php endif; ?>>
                            <i class="nav-icon <?php echo $menu->icon_menu; ?>"></i>
                            <p><?php echo $menu->modulo ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->