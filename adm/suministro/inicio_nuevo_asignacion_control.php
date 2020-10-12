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
    <script src="js/engineJS_21.js"></script>
    
    <script src="../../global_assets/js/plugins/extensions/rowlink.js"></script>
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
                        <?php include "./sidebar_almacen.php"; ?>
			<!-- /sidebar content -->
		</div>
		<!-- Main content -->
		<div class="content-wrapper">
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
                                    <div data-fab-label="Nueva asignación">
                                        <a href="#" class="btn bg-violet rounded-round btn-icon btn-float legitRipple" onclick="openCardNewAsignacion()">
                                            <i class="icon-pen-plus"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Search field -->
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-3 py-2">
                                    <h4 class="font-weight-semibold mb-1">Control de Asignación de Herramienta y Material de Trabajo 
                                        <a href="#" class="btn bg-transparent text-violet btn-icon mr-3 legitRipple">
                                            <i class="icon-design icon-2x"></i>
					</a>
                                    </h4>
                                </div>
                                <div class="input-group mb-sm-2">
                                    <div class="form-group-feedback form-group-feedback-left">
                                        <input type="text" class="form-control form-control-lg" placeholder="Buscar nombre del empleado" onClick="this.select();"   id="search_personal">
                                        <div class="form-control-feedback form-control-feedback-lg">
                                            <i class="icon-search4 text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-lg" onclick="buscar_empleado()">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /bottom right menu -->
                    <div class="card border-y-3 border-top-success border-bottom-success rounded-0" id="card_addAsignacion">
                        <div class="card-body" id="mod_pedido">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                    <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> DATOS DEL EMPLEADO</legend>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="solicitante" data-idempleado="" placeholder="Nombre del solicitante" readonly onkeyup="mayus(this);" required>
                                                <div class="form-control-feedback form-control-feedback-lg">
                                                    <i class="icon-plus-circle2 text-pink-800" data-toggle="modal" data-target="#busca_empleado" style="cursor: pointer"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group form-group-feedback form-group-feedback-left">
                                                <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="puesto" placeholder="Puesto" readonly onkeyup="mayus(this);" required>
                                                <div class="form-control-feedback form-control-feedback-sm">
                                                    <i class="icon-stack3"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-feedback form-group-feedback-left">
                                                <input type="date" class="form-control font-weight-semibold text-blue-800" id="fecha_actual" required>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-pen-plus mr-2"></i> BUSCAR MATERIAL A ASIGNAR </legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="i_noserie" readonly placeholder="S.N.">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-barcode2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="i_codigoinventario" readonly placeholder="Codigo de Inventario">
                                                    <div class="form-control-feedback form-control-feedback-lg">
                                                        <i class="icon-plus-circle2 text-pink-800" data-toggle="modal" data-target="#busca_articulo" style="cursor: pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="i_descripcion" readonly placeholder="Descripción">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-right">
                                                    <button type="button" class="btn btn-primary btn-icon ml-1" onclick="addElementToTable()" title="Agregar">Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tabla_pedidos" class="table datatable-selection-single" cellspacing="0" width="100%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="20%">
                                            <col width="60%">
                                            <thead>
                                              <tr>
                                                <th>S.N.</th> <!-- 0 -->
                                                <th>S.K.U</th> <!-- 3 -->
                                                <th>Fecha Entrega</th> <!-- 3 -->
                                                <th>Material</th>
                                              </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <div class="list-icons">
                                <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" style="display: none;" id="btn_del_row_sel" title="Remover item seleccionado"><i class="icon-trash"></i></button>
                                <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" id="btn_send_pedido" onclick="cerrarNewAsignacion()" title="Enviar solicitud">Cerrar <i class="icon-cross2 ml-2"></i></button>
                                <button type="button" class="btn btn-sm alpha-success text-success-800 legitRipple" id="btn_send_pedido" onclick="recorreDataTable()" title="Enviar solicitud">Enviar <i class="icon-paperplane ml-2"></i></button>
                                <button type="button" class="btn btn-sm text-danger-800 btn btn-link legitRipple d-none" id="folioxx" data-folioz="0"></button>
                            </div>
                        </div>
                    </div>
                    <!-- /dashboard content -->
                        <!-- /search field -->
                        <div class="card-group mb-sm-2">
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table datatable-basic" id="personal_tabla" style="width:100%">
                                            <col width="50%">
                                            <col width="45%">
                                            <col width="5%">
                                            <thead>
                                                <tr>
                                                    <th>Material</th>
                                                    <th>Fecha</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <h4 class="font-weight-semibold mb-1 text-center text-primary-800" id="nombre_empleado" data-idempleado=""></h4>
                                    <div class="table-responsive">
                                        <table class="table datatable-basic" id="solicitudes_tabla" style="width:100%">
                                            <col width="55%">
                                            <col width="10%">
                                            <col width="30%">
                                            <col width="5%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
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
                    <!-- /dashboard content -->
                    </div>
                    <!-- Modal with invoice -->
                    <div id="busca_empleado" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="table-responsive">
                                    <table class="table table-xs table-border-dashed datatable-basic text-nowrap" id="empleado_tabla_aplica" style="width:100%">
                                        <col width="10%">
                                        <col width="55%">
                                        <col width="5%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Puesto</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer bg-transparent">
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewEmp()">salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
                    <!-- Modal with invoice -->
                    <div id="busca_articulo" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="table-responsive">
                                    <table class="table table-xs table-border-dashed datatable-basic text-nowrap" id="articulo_tabla_aplica" style="width:100%">
                                        <col width="10%">
                                        <col width="50%">
                                        <col width="30%">
                                        <col width="10%">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripción</th>
                                                <th>Categoría</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer bg-transparent">
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewArt()">salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
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
