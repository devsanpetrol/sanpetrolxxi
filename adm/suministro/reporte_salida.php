<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include '../../bar_nav/title.php'; ?> - Reporte de Salida de Materiales de Almacén</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <link href="../../global_assets/js/plugins/tables/datatables/datatables/datatables.css" rel="stylesheet" type="text/css">
    <link href="css/css_custom.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="../../global_assets/js/main/jquery.min.js"></script>
    <script src="../../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="../../assets/js/app.js"></script>
    <!-- /theme JS files -->
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="../../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/tables/datatables/datatables/datatables.js"></script>
    <script src="../../global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_popups.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <script src="js/engineJS_23.js"></script>
    <!--<script src="js/ini_menu_almacen.js"></script>-->

    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switch.min.js"></script>
    
    <!-- /theme JS files -->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="../../../../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="../../../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
</head>

<body class="sidebar-xs">
        <?php include "../bar_nav/main_navbar.php"; ?>
	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<?php include "../bar_nav/main_sidebar.php"; ?>
		<!-- /main sidebar -->
		<!-- Secondary sidebar -->
		<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">
                    <!-- Sidebar mobile toggler -->
                    <div class="sidebar-mobile-toggler text-center">
                        <a href="#" class="sidebar-mobile-secondary-toggle">
                            <i class="icon-arrow-left8"></i>
                        </a>
                        <span class="font-weight-semibold">Secondary sidebar</span>
                        <a href="#" class="sidebar-mobile-expand">
                            <i class="icon-screen-full"></i>
                            <i class="icon-screen-normal"></i>
                        </a>
                    </div>
                    <!-- /sidebar mobile toggler -->
                    <!-- Sidebar content -->
                    <?php include "./sidebar_almacen.php"; ?>
                    <!-- /sidebar content -->
		</div>
		<!-- Main content -->
		<div class="content-wrapper">
                    <div class="content">
                    <!-- Right content -->
                    <div class="w-100">
                    <!-- /COL-MD-10 TABLA CONTENIDO -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                <div class="col-md-9">
                                    <h3>REPORTE DE SALIDA DE MATERIALES</h3>
                                </div>
                                <div class="col-md-3 text-right">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger daterange-ranges fecha-rango">
                                            <i class="icon-calendar22 mr-2"></i>
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datatable-basic text-nowrap" id="almacen_tabla" style="width:100%">
                                        <col width="20%">
                                        <col width="10%">
                                        <col width="40%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="40%">
                                        <thead>
                                            <tr>
                                                <th>Categoria</th>
                                                <th>Codigo</th>
                                                <th>Articulo</th>
                                                <th>Cantidad</th>
                                                <th>Unidad</th>
                                                <th>Solicitante</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- /COL-MD-10 TABLA CONTENIDO -->
                    </div>
                </div>
                <!-- /content area -->
                <!-- Modal new invoice -->
                <input type="hidden" id="filtro_fecha_inicio">
                <input type="hidden" id="filtro_fecha_fin">
                <!-- /modal with invoice -->
                <!-- Footer -->
                <?php include "../bar_nav/footer_navbar.php"; ?>
                <!-- /footer -->
            </div>
            <!-- /main content -->
	</div>
	<!-- /page content -->
    </body>
</html>
