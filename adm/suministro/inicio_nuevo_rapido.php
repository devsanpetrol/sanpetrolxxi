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
    <script src="js/engineJS_18.4.js"></script>

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
                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-md-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">SOLICITUD RÁPIDA</span></h4>
                                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                            </div>
                            <div class="header-elements d-none">
                                <form action="#">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <a href="#" class="btn bg-transparent text-danger btn-icon mr-3 legitRipple">
                                            <i class="icon-power2 icon-2x"></i>
					</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Content area -->
                    <div class="content">
                    <!-- Bottom right menu -->
                    <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" id="tools_menu_select" style="display: none;">
                        <li>
                            <button type="button" class="fab-menu-btn btn btn-success btn-float rounded-round btn-icon">
                                <i class="fab-icon-open icon-plus3"></i>
                                <i class="fab-icon-close icon-cross2"></i>
                            </button>
                            <ul class="fab-menu-inner">
                                <li>
                                    <div data-fab-label="Regresar">
                                        <a class="btn btn-light rounded-round btn-icon btn-float" data-btn_list="" data-idrow="" id="tools_menu_regresa" onclick="regresar_lista()">
                                            <i class="icon-undo2"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /bottom right menu -->
                    <div class="row" id="row_new_solicitudxx">
                        <div class="col-md-12">
                            <div class="card" id="card_addPedido">
                                <div class="card-body" id="mod_pedido">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset>
                                            <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> DATOS DEL SOLICITANTE</legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="solicitante" data-idempleado="" placeholder="Nombre del solicitante" readonly onkeyup="mayus(this);" required>
                                                        <div class="form-control-feedback form-control-feedback-lg">
                                                            <i class="icon-user-plus text-pink-800" data-toggle="modal" data-target="#busca_empleado" style="cursor: pointer"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="puesto" placeholder="Puesto" readonly onkeyup="mayus(this);" required>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-stack3"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="justificacion" placeholder="Motivo del requerimiento" onkeyup="mayus(this);" required>
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-question4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                            <legend class="font-weight-semibold text-danger-800"><i class="icon-clipboard6 mr-2"></i> DATOS DE LA SOLICITUD</legend>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="fecha_actual" placeholder="Fecha de Emisión">
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-calendar22"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control font-weight-semibold text-blue-800 new-solicitud-form" id="sitio" placeholder="Sitio de operación" onkeyup="mayus(this);" value="Base Sanpetrol Vhsa.">
                                                        <div class="form-control-feedback form-control-feedback-sm">
                                                            <i class="icon-pin-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6" id="content_destinos">
                                                    <div class="form-group">
                                                        <select data-placeholder="Destino de la solicitud (Area ó Equipo)" class="form-control form-control-select2 border-danger text-right" name='area_aquipo' data-idcoordinador="" id="area_aquipo" data-fouc>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <select data-placeholder="Area / Equipo" class="form-control form-control-select2 border-danger text-right" name='area_aquipo' id="sub_area_aquipo" data-fouc>
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                    </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <div class="list-icons">
                                                <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" style="display: none;" id="btn_del_row_sel" title="Remover item seleccionado"><i class="icon-trash"></i></button>
                                                <button type="button" class="btn btn-sm btn-success" id="btn_send_pedido" onclick="get_folio()" title="Enviar solicitud">Guardar <i class="icon-floppy-disk ml-2"></i></button>
                                                <button type="button" class="btn btn-sm text-danger-800 btn btn-link legitRipple d-none" id="folioxx" data-folioz="0"></button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-pen-plus mr-2"></i> AGREGAR ARTICULO </legend>
                                            <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_codigobarra" placeholder="Codigo de Barra">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-barcode2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_codigoinventario" readonly placeholder="Codigo de Inventario">
                                                            <div class="form-control-feedback form-control-feedback-lg">
                                                                <i class="icon-square-up-right text-pink-800" data-toggle="modal" data-target="#busca_articulo" style="cursor: pointer"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_descripcion" readonly placeholder="Descripción">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_cantidad" placeholder="Cantidad">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_unidad" readonly placeholder="Unidad">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group text-right">
                                                            <button type="button" class="btn btn-primary legitRipple btn-icon ml-1" onclick="agregar_pedido()" title="Agregar"><i class="icon-add-to-list"></i></button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="tabla_pedidos" class="table datatable-selection-single" cellspacing="0" width="100%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="70%">
                                                <thead>
                                                  <tr>
                                                    <th>Clave</th> <!-- 0 -->
                                                    <th>Cantidad</th> <!-- 1 -->
                                                    <th>Unidad</th> <!-- 2 -->
                                                    <th>Articulo</th> <!-- 3 -->
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
                    </div>
                    <!-- /dashboard content -->
                    </div>
                    <!-- /content area -->
                    <!-- Modal with invoice -->
                    <div id="busca_articulo" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="table-responsive">
                                    <table class="table table-xs table-border-dashed datatable-basic text-nowrap" id="articulo_tabla_aplica" style="width:100%">
                                        <col width="10%">
                                        <col width="55%">
                                        <col width="30%">
                                        <col width="5%">
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
                                    <button type="button" class="btn btn-sm btn-success legitRipple" onclick="actualizarTabla()" title="Refrescar tabla"><i class="icon-rotate-cw3"></i></button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewArt()">salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
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
                    <!-- Footer -->
                    <?php include "../bar_nav/footer_navbar.php"; ?>
                    <!-- /footer -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
        
</body>
</html>
