<?php require_once "../../ini_ses.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include "../../bar_nav/title.php"; ?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/colors.min.css" rel="stylesheet" type="text/css">
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
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/tables/datatables/datatables/datatables.js"></script>
    <script src="../../global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_popups.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <script src="js/engineJS_11.js"></script>

    <script src="../../global_assets/js/plugins/extensions/rowlink.js"></script>
    <script src="../../global_assets/js/demo_pages/picker_date.js"></script>
    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switch.min.js"></script>
    <!-- /theme JS files -->
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
                            <span class="font-weight-semibold">Modulo Almacén</span>
                            <a href="#" class="sidebar-mobile-expand">
                                <i class="icon-screen-full"></i>
                                <i class="icon-screen-normal"></i>
                            </a>
			</div>
			<!-- /sidebar mobile toggler -->
			<!-- Sidebar content -->
			<div class="sidebar-content">
                            <!-- Sub navigation -->
                            <div class="card">
                                <div class="card-header bg-transparent header-elements-inline">
                                    <span class="text-uppercase font-size-sm font-weight-semibold">Menú</span>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a class="list-icons-item" data-action="collapse"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                                        <li class="nav-item-header">Salida Almacen</li>
                                        <li class="nav-item">
                                            <a href="aprobacion_salida.php" class="nav-link" ><i class="icon-drawer-in"></i> Bandeja entrada <span class="badge badge-pill ml-auto nuevas-entradas-inbox">0</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="aprobacion_salida.php" class="nav-link"><i class="icon-spam"></i> No Autorizados</a>
                                        </li>
                                        <li class="nav-item-header">Enviar a Compra</li>
                                        <li class="nav-item">
                                            <a href="aprobacion_salida_compra.php" class="nav-link" ><i class="icon-drawer-in"></i> Bandeja entrada <span class="badge badge-pill ml-auto nuevas-entradas-inbox">0</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="salida_compra_no_aprobada.php" class="nav-link"><i class="icon-spam"></i> No Autorizados</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- Main content -->
		<div class="content-wrapper">
                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-md-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Supervisión de Lista a Compra</span></h4>
                                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                            </div>
                            <div class="header-elements d-none">
                                <form action="#">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="search" class="form-control wmin-200" placeholder="Buscar..." id="buscar_en_tabla_vobo">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4 font-size-base text-muted"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Content area -->
                    <div class="content">
                        <!-- Right content -->
                        
                <!-- Single line -->
                <div class="card" id="tabla_visor_solicitudes">
                    <!-- Table -->
                    <div class="table-responsive" id="content_table_pedidos_list" data-scroll="">
                        <table class="table table-inbox" id="lay_out_solicitudesx" cellspacing="0" width="100%">
                            <col width="10%">
                            <col width="10%">
                            <col width="80%">
                            <!--<col width="15%">-->
                            <thead>
                                <tr>
                                    <th class="table-inbox-time text-center">Revisado</th>
                                    <th class="table-inbox-time text-center">Fecha</th>
                                    <th class="table-inbox-message">Material solicitado</th>
                                    <!--<th class="table-inbox-time text-center">Folio</th>-->
                                </tr>
                            </thead>
                            <tbody data-link="row" class="rowlink">
                            </tbody>
                        </table>
                    </div>
                    <!-- /table -->
                </div>
                <!-- /single line -->
                <!-- Bottom tabs -->
                <div class="card" id="panel_autoizacion_salida" style="display: none;">
                    <div class="card-header bg-white pb-0 pt-sm-0 pr-sm-0 header-elements-sm-inline">
                        <h6 class="card-title"></h6>
                        <ul class="nav nav-tabs nav-tabs-bottom card-header-tabs mx-0">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7 mr-2"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a tabindex="-1" class="dropdown-item" data-btn_list="" data-idrow="" id="tools_menu_regresa" onclick="regresar_lista()">
                                        <i class="icon-arrow-left13"></i>
                                        Regresar
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-xs dt-responsive" id="dt_for_vobo" width="100%">
                            <col width="6%">
                            <col width="4%">
                            <col width="30%">
                            <col width="30%">
                            <col width="30%">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Autorizar</th>
                                    <th>Articulo</th>
                                    <th>Destino</th>
                                    <th>Justificación</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer align-items-center">
                        <div class="row w-100">
                            <div class="col-sm-3 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-pink text-center" readonly id="firma_almacenista" data-idempleado="">
                                    <div class="d-block form-text text-center">
                                        <span class="badge">Encargado Almacen</span>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" disabled>
                                            <i class="icon-pencil3 text-blue-800"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-pink text-center" readonly data-idempleado="" data-tokenid="salida_almacen_vobo_1" id="firma_vobo">
                                    <div class="d-block form-text text-center">
                                        <span class="badge">Vo. Bo.</span>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" id="id_firma_vobo" onclick="firma_almacen('firma_vobo')">
                                            <i class="icon-pencil3 text-blue-800"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                </div>
                                <textarea rows="1" cols="3" class="form-control form-control-sm font-weight-semibold text-blue-800" id="vale_observacion" maxlength="200" readonly></textarea>
                                <div class="d-block form-text text-justify">
                                    <span class="badge">Observación</span>
                                </div>
                            </div>
                            <div class="col-sm-2 form-group text-right">
                                <button type="button" class="btn btn-success btn-sm" data-aprobado="" id="btn_envia_guarda_valesalida" onclick="guarda_cambios()">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /bottom tabs -->
            
                        <!-- /right content -->
                    </div>
                    <!-- /large modal -->
                    <div id="mod_log_acces" class="modal fade" tabindex="-1" data-firmax="">
                <div class="modal-dialog modal-xs">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Login form -->
                            <div class="text-center mb-3">
                                <img src="../../global_assets/images/placeholders/Imagen4.jpg" class="img-fluid" width="120" height="50">
                                <h5 class="mb-0">AUTENTIFICAR</h5>
                            </div>
                            <form autocomplete="off" id="log_autentic_almacenista" >
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" class="form-control" autocomplete="off" placeholder="Usuario" name="usuario" id="usuario">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password">
                                    <div class="form-control-feedback">
                                        <i class="icon-key text-muted"></i>
                                    </div>
                                </div>
                                <div class="alert alert-danger border-0 alert-dismissible text-center" style="display: none;padding-right: 20px;" id="msj_alert">
                                </div>
                                <div class="text-right">
                                    <button type="button" class="btn btn-link legitRipple btn-sm" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="log_autentic()">Aceptar</button>
                                </div>
                            </form>
                            <!-- /login form -->                                              
                        </div>
                    </div>
                </div>
            </div>
            <!-- /large modal -->
            <!-- /content area -->
            <!-- Footer -->
            <?php include "../bar_nav/footer_navbar.php"; ?>
            <!-- /footer -->
        </div>
        <!-- /main content -->
	</div>
	<!-- /page content -->

</body>
</html>
