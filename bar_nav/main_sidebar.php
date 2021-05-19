<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle"><i class="icon-arrow-left8"></i></a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="index.php">
                        <img src="global_assets/images/placeholders/Imagen3.png" class="img-fluid rounded-circle mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark" id="user_session_id" data-employeid="<?php echo $_SESSION['id_empleado']; ?>"><?php echo ucwords(mb_strtolower ($_SESSION['full_name'],'UTF-8')); ?></h6>
                    <span class="font-size-sm text-white text-shadow-dark"><?php echo ucwords(mb_strtolower ($_SESSION['especialista'],'UTF-8')); ?></span>
                </div>
                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Mi cuenta</span></a>
                </div>
            </div>
            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="./login/logout.php" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Salir</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">ALMACÉN</div> <i class="icon-menu" title="Inicio"></i></li>
                <li class="nav-item">
                    <a href="adm/suministro/almacen.php" class="nav-link">
                    <i class="icon-home4"></i>
                    <span>Principal</span>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Inicio</div> <i class="icon-menu" title="Inicio"></i></li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                    <i class="icon-home4"></i>
                    <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Suministro</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/inicio.php">Adquisición de Material</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/almacen.php">Almacen</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/coordinacion_test.php">Coordinación Testing</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/coordinacion_swab.php">Coordinación Swabing</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/coordinacion_ssac.php">Coordinación SSAC</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/coordinacion_plan.php">Planeación de Proyecto</a></li>
                        <li class="nav-item"><a class="nav-link" href="adm/suministro/personal.php">Catálogo</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="adm/suministro/aprobacion_salida.php">Supervisión</a></li>-->
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>