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
    <script src="js/engineJS.js"></script>

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
                            <span class="font-weight-semibold">Secondary sidebar</span>
                            <a href="#" class="sidebar-mobile-expand">
                                <i class="icon-screen-full"></i>
                                <i class="icon-screen-normal"></i>
                            </a>
			</div>
			<!-- /sidebar mobile toggler -->
			<!-- Sidebar content -->
			<div class="sidebar-content">
                            <!-- Actions -->
                            <div class="card">
                                <div class="card-header bg-transparent header-elements-inline">
                                    <span class="text-uppercase font-size-sm font-weight-semibold">Nueva</span>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a class="list-icons-item" data-action="collapse"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="inicio_nuevo.php" class="btn bg-teal btn-block">Solicitud</a>
                                </div>
                            </div>
                            <!-- /actions -->
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
                                        <li class="nav-item-header">Folders</li>
                                        <li class="nav-item">
                                            <a href="inicio.php" class="nav-link active">
                                                <i class="icon-folder-open2"></i>
                                                Mis solicitudes
                                                <span class="badge bg-success badge-pill ml-auto" id="total_pedidos_mostrado">0</span>
                                            </a>
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
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Solicitudes</span></h4>
                                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                            </div>
                            <div class="header-elements d-none">
                                <form action="#">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="search" class="form-control wmin-200" placeholder="Buscar..." id="buscar_en_tabla_layoutx">
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
                    <!-- Bottom right menu -->
                    <!-- Right content -->
                    <div class="flex-fill overflow-auto">
                        <!-- Single line -->
                        <div class="card" id="tabla_visor_solicitudes">
                            <!-- Table -->
                            <div class="table-responsive" id="content_table_pedidos_list" data-scroll="">
                                <table class="table" id="lay_out_solicitudesx" cellspacing="0" width="100%">
                                    <col width="30%">
                                    <col width="50%">
                                    <col width="20%">
                                    <thead style="display: none">
                                        <tr>
                                            <th>Equipo</th> <!-- 4 -->
                                            <th>Materiales solicitados</th> <!-- 3 -->
                                            <th>Fecha</th> <!-- 2 -->
                                        </tr>
                                    </thead>
                                    <tbody data-link="row" class="rowlink">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /table -->
                        </div>
                        <!-- /single line -->
                    </div>
                    <!-- /right content -->
                    </div>
                    <!-- /content area -->
                    <div id="modal_detail_solicitud" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-solicitud="">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger" style=" opacity: 0;"><i class="icon-clipboard6 mr-2"></i></legend>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 text-right" readonly disabled value="De">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 text-right" readonly disabled value="Para">
                                                    </div>
                                                </div>
                                            </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-7">
                                            <fieldset>
                                            <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> INFORMACIÓN DE LA SOLICITUD</legend>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800" id="solicitante" readonly>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-man"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800" id="puesto" readonly>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5" style="display: none">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800" id="fecha_actual" readonly>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-calendar22"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800" data-idcoordinador="" id="area_aquipo" readonly>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-clipboard5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800" id="sitio" readonly>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-pin-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        </div>
                                        <div class="col-sm-4">
                                            <fieldset>
                                            <legend class="font-weight-semibold text-danger-800"><i class="icon-clipboard6 mr-2"></i> REVISIÓN</legend>
                                            <div class="row">
                                                <div class="col-sm-9 form-group text-right">
                                                    <span class="font-weight-bold">Coordinador de Operación:</span>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <span class="badge badge-warning">Pendiente</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-9 form-group text-right">
                                                    <span class="font-weight-bold">Planeacion de Proyectos:</span>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <span class="badge badge-danger">Pendiente</span>
                                                </div>
                                            </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="tabla_pedidos" class="table datatable-selection-single datatable-scroll-y" cellspacing="0" width="100%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="30%">
                                                <col width="25%">
                                                <col width="25%">
                                                <thead>
                                                  <tr>
                                                    <th>Cantidad</th> <!-- 1 -->
                                                    <th>Unidad</th> <!-- 2 -->
                                                    <th>Articulo</th> <!-- 3 -->
                                                    <th>Motivo del requerimiento</th> <!-- 5 -->
                                                    <th>Destino</th> <!-- 6 -->
                                                  </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="closeModalSolicitudDetail()" title="Salir del formulario">Salir</button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="" title="Guardar cambios" onclick="guardarCambios()">Firmar</button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="" title="Guardar cambios" onclick="guardarCambios()">Guardar</button>
                                </div>
                            </div>
                        </div>
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
