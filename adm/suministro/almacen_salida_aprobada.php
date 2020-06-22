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
    <script src="js/engineJS_3.js"></script>
    <script src="js/ini_menu_almacen.js"></script>

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
                <?php include "./sidebar_almacen.php"; ?>
                <!-- /sidebar content -->
            </div>
		<!-- Main content -->
            <div class="content-wrapper">
                    <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Entrega de Material</span></h4>
                    </div>
                </div>
            </div>
            <!-- Content area -->
            <div class="content">
                <div class="d-flex align-items-start flex-column flex-md-row">
                    <div class="w-100 order-2 order-md-1">
                        <!-- CARDS -->
                        <div class="card" id="card_solicitud_detail" style="display: none;">
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <fieldset>
                                                    <div class="row">
                                                        <div class="col-sm-5 form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12 form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 form-group">
                                                                        <span class="font-weight-bold font-size-lg">Solicitante: </span>
                                                                        <span class="font-weight-bold font-size-lg ml-1 text-blue-800" id="solicitante"></span>
                                                                        </div>
                                                                    </div>
                                                                    </br>
                                                                    <div class="row">
                                                                        <div class="col-sm-12 form-group">
                                                                        <span class="font-weight-bold font-size-lg">Equipo / Sitio: </span>
                                                                        <span class="font-weight-bold font-size-lg ml-1 text-blue-800" id="area_aquipo" data-idcoordinador=""></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <div class="row" id="s_pendiente">
                                                                <div class="col-sm-12 form-group">
                                                                   <div class="form-group form-group-feedback form-group-feedback-left">
                                                                        <input type="text" class="form-control text-blue-800" id="nombre_recibe" data-foliovalesalida="" onkeyup="mayus(this)">
                                                                        <span class="form-text text-muted text-right font-size-xs" id="motivo_sub">Nombre del personal que recibe</span>
                                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                                            <i class="icon-user-check"></i>
                                                                        </div>
                                                                    </div> 
                                                                </div>  
                                                            </div>
                                                            <div class="row" id="s_completado">
                                                                <div class="col-sm-12 form-group">
                                                                <span class="font-weight-bold font-size-lg">Recibió: </span>
                                                                <span class="font-weight-bold font-size-lg ml-1 text-blue-800" id="recibio_surtido"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 form-group"></div>
                                                        <div class="col-sm-2 form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12 form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-5 form-group">
                                                                            <span class="font-weight-bold font-size-lg">Folio:</span>
                                                                        </div>
                                                                        <div class="col-sm-7 form-group">
                                                                            <span class="btn btn-sm badge legitRipple legitRipple-empty badge-danger d-block" id="folio_vale" data-foliovale="" data-foliopedido=""></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table id="tabla_pedidos" class="table datatable-scroll-y" cellspacing="0" width="100%" data-folio="">
                                                            <col width="35%">
                                                            <col width="30%">
                                                            <col width="5%">
                                                            <col width="5%">
                                                            <col width="20%">
                                                            <col width="5%">
                                                            <thead>
                                                              <tr>
                                                                <th>Articulo</th> <!-- 0 -->
                                                                <th>Equipo/Justificacion</th> <!-- 0 -->
                                                                <th>Cantidad</th> <!-- 1 -->
                                                                <th>Unidad</th> <!-- 2 -->
                                                                <th>Recibe</th>
                                                                <th></th> <!-- 2 -->
                                                              </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="guarda_itemsentrega()" title="Finalizar vale de salida" id="guarda_cambios_solicitud">Finalizar</button>
                                <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple btn-icon " onclick="envia()" title="Imprimir"><i class="icon-printer"></i> Imprimir</button>
                                <button type="button" class="btn btn-sm alpha-danger  text-danger-800  legitRipple" onclick="closeModalSolicitudDetail()" title="Salir del formulario">Salir</button>
                            </div>
                        </div>
                        <!-- Invoice archive -->
                        <div class="card" data-vista="no" id="card_almacen_pase">
                            <div class="card-body">
                                <table class="table table-responsive-sm table-xs dt-responsive" id="datatable_almacen_salida" width="100%">
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="5%">
                                    <col width="30%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="5%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Status</th>
                                            <th>Equipo / Destino</th>
                                            <th>Solicitante</th>
                                            <th>Recibe</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /invoice archive -->
                    </div>
                </div>
                <!-- /inner container -->
            </div>
            <!-- Footer -->
            <?php include "../bar_nav/footer_navbar.php"; ?>
            <!-- /footer -->
            </div>
            <!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>
