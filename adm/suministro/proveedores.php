<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include '../../bar_nav/title.php'; ?></title>
    
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../../global_assets/css/icons/material/styles.min.css" rel="stylesheet" type="text/css">
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
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_popups.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <script src="js/engineJS_27.js"></script>
    <script src="js/ini_menu_almacen.js"></script>

    <script src="../../global_assets/js/plugins/extensions/rowlink.js"></script>
    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switch.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script src="../../global_assets/js/demo_pages/form_actions.js"></script>
    
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
                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-md-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Almacén</span></h4>
                                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content area -->
                    <div class="content">
                        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="hover" data-fab-state="close">
                            <li>
                                <a class="fab-menu-btn btn bg-success btn-float rounded-round btn-icon legitRipple">
                                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                                    <i class="fab-icon-close icon-cross2"></i>
                                </a>
                                <ul class="fab-menu-inner">
                                    <li>
                                        <div data-fab-label="Nuevo Proveedor">
                                            <a href="#" data-toggle="modal" data-target="#busca_proveedor" class="btn bg-primary rounded-round btn-icon btn-float legitRipple">
                                                <i class="icon-truck"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datatable-basic" id="almacen_tabla" style="width:100%">
                                        <col width="15%">
                                        <col width="20%">
                                        <col width="15%">
                                        <col width="16.6%">
                                        <col width="16.6%">
                                        <col width="16.6%">
                                        <thead>
                                            <tr>
                                                <th>Actividad Comercial</th>
                                                <th>Proveedor</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>E-Mail</th>
                                                <th>Contacto</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /content area -->
                    <!-- Modal with busca_proveedor -->
                    <div id="busca_proveedor" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="card-body" id="cardnewprov">
                                    <form action="#" id="formnewprov">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-pencil5 mr-2"></i> Alta de Proveedor</legend>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_nombre" placeholder="Nombre de la empresa">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-office"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_rfc" placeholder="R.F.C.">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-shield-check"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_direccion" placeholder="Dirección *" onkeyup="mayus(this);">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-location4"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_actividad_comercial" placeholder="Actividad comercial">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-info22"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_num_telefono" placeholder="Telefonos">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_email" placeholder="E-Mail">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-envelop3"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_pagina_web" placeholder="Pagina web">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-earth"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="hide_showModalNewProv()" title="Cerrar"><i class="icon-cross2"></i></button>
                                                        <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="guarda_new_prov()" title="Guardar">Guardar</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger border-0 alert-dismissible" id="msj_alert2" style="display: none;">
                                                            <button type="button" class="close" onclick="close_alert2()"><span>×</span></button>
                                                            <span class="font-weight-semibold">Error! </span> Debe completar el formulario <a href="#" class="alert-link" onclick="close_alert2()">Intentar nuevamente</a>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
