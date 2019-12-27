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
    <script src="js/engineJS_5.js"></script>

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
                                    <a onclick="fecha_actual()" class="btn bg-teal btn-block">Solicitud</a>
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
                                            <a href="inicio.php" class="nav-link">
                                                <i class="icon-drawer-in"></i>
                                                Entradas
                                                <span class="badge bg-success badge-pill ml-auto" id="total_pedidos_mostrado" style="display: none;">0</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="inicio_send.php" class="nav-link"><i class="icon-drawer3"></i> Enviados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link"><i class="icon-drawer-out"></i> Por revisar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link"><i class="icon-stars"></i> Mis Solicitudes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link"><i class="icon-spam"></i>No Autorizados
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
                                <div class="card-header bg-white header-elements-inline">
                                    <h6 class="card-title">Nueva solicitud</h6>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                                <div class="ml-3">
                                                    <h6 class="font-weight-semibold mb-0 text-blue-800" ></h6>
                                                </div>
                                            </div>
                                            <button type="button" class="btn text-primary-800 btn btn-link legitRipple" id="fecha_actual"></button>
                                            <button type="button" class="btn btn-outline bg-primary text-primary-800 rounded-round btn-icon ml-2" id="btn_info_formato" data-toggle="modal" data-target="#mod_num_formato"><i class="icon-info22"></i></button>
                                            <button type="button" class="btn btn-outline bg-primary text-primary-800 rounded-round btn-icon ml-2" id="btn_send_pedido" onclick="get_folio()"><i class="icon-paperplane"></i></button>
                                            <button type="button" class="btn btn-outline rounded-round btn-icon ml-2 bg-primary text-primary-800 btn-sm" onclick="show_addpedido()" id="btn_add_pedido"><i class="icon-add"></i></button>
                                            <button type="button" class="btn btn-sm text-danger-800 btn btn-link legitRipple" id="folioxx" data-folioz="0"></button>
                                            <button type="button" class="btn btn-sm btn-outline bg-danger text-danger-800 rounded-round btn-icon ml-2" style="display: none;" id="btn_del_row_sel"><i class="icon-trash"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline bg-primary text-primary-800 rounded-round btn-icon ml-2" data-toggle="modal" data-target="#modal_large"><i class="icon-plus3"></i></button>
                                        </div>
                                    </div>      
                                </div>
                                <div class="card-body" id="mod_pedido">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="tabla_pedidos" class="table datatable-selection-single" cellspacing="0" width="100%">
                                            <thead>
                                              <tr>
                                                <th></th> <!-- 0 -->
                                                <th>Clave</th> <!-- 0 -->
                                                <th>Articulo</th> <!-- 1 -->
                                                <th>Articulo</th> <!-- 2 -->
                                                <th>Unidad</th> <!-- 3 -->
                                                <th>Cantidad</th> <!-- 4 -->
                                                <th>Descripció detallada</th> <!-- 5 -->
                                                <th>Area ó equipo destinado</th> <!-- 6 -->
                                                <th>Justificación</th> <!-- 7 -->
                                                <th>Anexo/Condición</th> <!-- 8 -->
                                                <th>Aprueba</th> <!-- 9 -->
                                                <th>Grado Requerimiento</th> <!-- 10 -->
                                                <th>Fecha Requerimiento</th> <!-- 11 -->
                                                <th>ID Categoría</th> <!-- 12 -->
                                                <th>ID destino</th> <!-- 13 -->
                                                <th>cantidad_apartado</th> <!-- 12 -->
                                                <th>cantidad_compra</th> <!-- 13 -->
                                              </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /dashboard content -->

                    </div>
                    <!-- /content area -->
                    <!-- Area modal -->
                    <div id="modal_large" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                <form id="add_articulo" data-numformat="SP-MX-CA-FO-003" data-idformat="1">
                                    <div class="form-group row">
                                      <div class="col-sm-11 form-group-feedback form-group-feedback-right">
                                          <label class="font-weight-bold">Busqueda de articulo</label>
                                          <div class="input-group">
                                              <select data-placeholder="Buscar en almacen..." class="form-control select-minimum form-control-sm" data-fouc name='articulo_cod' id="select_article">
                                              </select>
                                              <div class="form-control-feedback text-danger">
                                                <button type="button" class="btn text-pink-800 btn-link form-control-sm" onclick="reset_select2()" title="Remover selección actual"><i class="icon-spinner11"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-1 form-group form-group-feedback-right text-center">

                                      </div>
                                      <div class="col-sm-12 form-group form-group-feedback-right"></div>
                                      <div class="col-sm-4 form-group form-group-feedback-right">
                                        <label class="d-block font-weight-bold">Grado de Requerimiento de la compra</label>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input-styled-primary form-control-sm" name="grado_r" value="inmediato" checked data-fouc>
                                                Inmediata
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input-styled-primary form-control-sm" name="grado_r" value="programado" data-fouc>
                                                Programada
                                            </label>
                                        </div>
                                      </div>
                                      <div class="col-sm-4 form-group form-group-feedback-right">
                                        <div class="controls">
                                          <div class="col-md-12 form-group-feedback form-group-feedback-right">
                                            <label class="font-weight-bold">Fecha estimada de requerimiento</label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                </span>
                                                <input type="text" class="form-control form-control-sm daterange-single font-weight-semibold text-blue-800" value="" id="single_cal3">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-4 form-group form-group-feedback-right">
                                        <label class="d-block font-weight-bold">Grado de Requerimiento de la compra</label>
                                        <div class="form-check form-check-switchery form-check-inline form-check-right">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input-switchery" checked data-fouc>
                                                Autorizar
                                            </label>
                                        </div>
                                      </div>
                                      <div class="col-sm-2 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Codigo</label>
                                        <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="cod_articulo" readonly>
                                      </div>
                                      <div class="col-sm-6 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Articulo</label><label style="color: red;"> *</label>
                                        <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="descripcion" required="true" onkeyup="mayus(this);">
                                      </div>
                                      <div class="col-sm-2 form-group form-group-feedback-right">
                                        <label class="font-weight-bold" data-fouc>Unidad</label>
                                        <select name="select" class="form-control form-control-sm font-weight-semibold text-blue-800 select" id="unidad">
                                          <option value="pza" selected>Pieza</option>
                                          <option value="kgr">Kilogramo</option>
                                          <option value="mtr">Metro</option>
                                          <option value="pqt">Paquete</option>
                                          <option value="cja">Caja</option>
                                          <option value="ltr">Litro</option>
                                          <option value="lte">Lote</option>
                                          <option value="kit">Kit</option>
                                          <option value="par">Par</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-2 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Cantidad | </label>
                                        <span class="text-blue-800 font-weight-bold" id="stock_disponible" data-almacen="0" title="Cantidad disponible en almacen"><i class="icon-database4"></i> 0</span>
                                        <span class="text-danger-800 font-weight-bold" id="stock_compra" title="Cantidad que sera enviada a compra"><i class="icon-cart-add2"></i> 0</span>
                                        <input type="number" class="form-control form-control-sm font-weight-semibold text-blue-800" step="1" value="1" min="0" id="cantidad" value="0" required="true">
                                      </div>
                                      <div class="col-sm-9 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Descripción detallada</label>
                                        <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="especificacion" onkeyup="mayus(this);">
                                      </div>
                                      <div class="col-sm-3 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Categoria</label>
                                        <select name="select" class="form-control form-control-sm font-weight-semibold text-blue-800 select" data-fouc id="select_categoria" required>
                                        </select>
                                      </div>
                                      <div class="col-sm-6 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Anexo/Condición</label>
                                        <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="anexo" onkeyup="mayus(this);">
                                      </div>
                                      <div class="col-sm-6 form-group form-group-feedback-right" id="content_destinos">
                                        <label class="font-weight-bold">Area/Equipo destinado</label><label style="color: red;"> *</label>
                                        <div class="input-group">
                                              <select data-placeholder="Area, Equipo, Empleado,..." class="form-control select-minimum form-control-sm" data-fouc name='area_aquipo' data-textvalue="" id="area_aquipo">
                                              </select>
                                              <div class="form-control-feedback text-danger">
                                                <button type="button" class="btn text-pink-800 btn-link form-control-sm" onclick="reset_select3()" title="Remover selección actual"><i class="icon-spinner11"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-12 form-group form-group-feedback-right">
                                        <label class="font-weight-bold">Justificación de compra</label><label style="color: red;"> *</label>
                                        <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="justificacion" required="true" onkeyup="mayus(this);">
                                      </div>
                                    </div>
                                </form>                                                    
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-outline bg-danger-300 rounded-round btn-icon ml-2 btn-sm" onclick="resetModalPedido()"><i class="icon-exit2"></i> Salir</button>
                                    <button type="button" class="btn btn-outline bg-slate rounded-round btn-icon ml-2 btn-sm" onclick="agregar_pedido()"><i class="icon-download4"></i> Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /large modal -->
                    <div id="mod_num_formato" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Numero de formato</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="num_formato" readonly>
                                        </div>
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Función</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="funcion" readonly>
                                        </div>
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Región</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="region" readonly>
                                        </div>
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Fecha de Rev.</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="fecha_rev" readonly>
                                        </div>
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Autorizado por</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="autorizado" readonly>
                                        </div>
                                        <div class="col-md-6 form-group form-group-feedback-right">
                                          <label class="font-weight-bold">Revisado por</label>
                                          <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="revisado" readonly>
                                        </div>
                                    </div>                                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /large modal -->
                    <div id="pase_salida" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Table -->
                                        <div class="table-responsive" id="table_pase_salida">
                                            <table class="table table-inbox" id="lay_out_salida" cellspacing="0" width="100%">
                                                <thead style="display: none">
                                                    <tr>
                                                      <th>Id pedido</th>
                                                      <th>Articulo</th>
                                                      <th>Cantidad</th>
                                                      <th>Unidad</th>
                                                      <th>Destino</th>
                                                      <th>status</th>
                                                      <th>Cod Articulo</th>
                                                      <th>Folio</th>
                                                      <th>Autoriza</th>
                                                      <th>Categoria</th>
                                                      <th>Stock Alm.</th>
                                                    </tr>
                                                </thead>
                                                <tbody data-link="row" class="rowlink">
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /table -->
                                    </div>                                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Area modal -->
                    <!-- Footer -->
                    <?php include "../bar_nav/footer_navbar.php"; ?>
                    <!-- /footer -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>
