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
    <script src="../../assets/js/app.js"></script>
    <!-- /theme JS files -->
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="../../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
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
    <script src="../../global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <!-- Theme JS files -->   
    <script src="../../global_assets/js/plugins/extensions/rowlink.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- /theme JS files -->
     <script src="js/engineJS_9.js"></script>
     <script src="js/ini_menu_almacen.js"></script>
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
                        <?php include "./sidebar_almacen.php"; ?>
			<!-- /sidebar content -->
		</div>
		<!-- Main content -->
		<div class="content-wrapper">
                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-md-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-cart5 mr-2"></i> <span class="font-weight-semibold">Generar Lista de Compra</span></h4>
                            </div>

                        </div>
                    </div>
                    <!-- Content area -->
            <div class="content">
                <!-- Invoice archive -->
                <div class="card" data-vista="no" id="card_almacen_pase" style="display: none;">
                    <div class="card-header bg-white header-elements-sm-inline">
                        <h6 class="card-title"></h6>
                        <div class="header-elements">Folio: 
                            <span class="badge badge-danger ml-3" id="num_folio_vale_salida"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-xs dt-responsive" id="datatable_almacen_pase" width="100%">
                            <col width="10%">
                            <col width="40%">
                            <col width="35%">
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">
                            <col>
                            <thead>
                                <tr>
                                    <th>Surtir</th>
                                    <th>articulo</th>
                                    <th>Destino</th>
                                    <th>Apartado</th>
                                    <th>Entregado</th>
                                    <th>Accion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="row w-100">
                            <div class="col-sm-3 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-pink text-center" readonly data-idempleado="" data-tokenid="salida_almacen_01" id="firma_almacenista">
                                    <div class="d-block form-text text-center">
                                        <span class="badge">Encargado Almacen</span>
                                        <i class="icon-checkmark-circle text-success" id="firma_almacenista_check" style="display: none;"></i>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" onclick="firma_almacen('firma_almacenista')">
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
                                        <i class="icon-checkmark-circle text-success" id="firma_vobo_check" style="display: none;"></i>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" onclick="firma_almacen('firma_vobo')">
                                            <i class="icon-pencil3 text-blue-800"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    </div>
                                <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="vale_observacion" onkeyup="mayus(this);" maxlength="200">
                                    <div class="d-block form-text text-justify">
                                        <span class="badge">Observación</span>
                                </div>
                            </div>
                            <div class="col-sm-2 form-group text-right">
                                <button type="button" class="btn btn-success btn-sm" data-aprobado="" id="btn_envia_valesalida" onclick="insert_vale_salida()" disabled><i class="icon-clipboard5 mr-2"></i> Enviar</button>
                            </div>
                            </div>
                    </div>
                </div>
                <!-- /invoice archive -->
                <!-- Invoice archive -->
                <div class="card card-pedidos-xsurtir">
                    <table class="table table-responsive-sm table-xs dt-responsive" id="datatable_almacen_salida" width="100%">
                        <col width="3%">
                        <col width="42%">
                        <col width="20%">
                        <col width="5%">
                        <col width="20%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>articulo</th>
                                <th>Destino</th>
                                <th>Apartado</th>
                                <th>FechaFolio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /invoice archive -->
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
                    <!-- Footer -->
                    <?php include "../bar_nav/footer_navbar.php"; ?>
                    <!-- /footer -->
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
