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
    <script src="js/engineJS_15.js"></script>

    <script src="../../global_assets/js/plugins/extensions/rowlink.js"></script>
    <script src="../../global_assets/js/demo_pages/picker_date.js"></script>
    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switch.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_scrollspy.js"></script>
   
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
                                            <a href="coordinacion_test.php" class="nav-link active">
                                                <i class="icon-folder-open2"></i>
                                                Solicitudes
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
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">PLANEACION DE PROYECTOS</span></h4>
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
                        <!-- Inner container -->
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
                                                                    <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> INFORMACIÓN DE LA SOLICITUD</legend>
                                                                    <div class="row">
                                                                        <div class="col-sm-6 form-group">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 form-group">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12 form-group">
                                                                                        <span class="font-weight-bold font-size-lg">Solicitante: </span>
                                                                                        <span class="font-weight-bold font-size-lg ml-1 text-blue-800" id="solicitante"></span>
                                                                                        <span class="font-weight-bold font-size-lg ml-3">Fecha: </span>
                                                                                        <span class="font-weight-bold font-size-lg ml-1 text-blue-800" id="fecha_actual"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    </br>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12 form-group">
                                                                                        <span class="font-weight-bold font-size-lg">Equipo / Sitio: </span>
                                                                                        <span class="font-weight-bold font-size-lg ml-1 text-danger-800" id="area_aquipo" data-idcoordinador=""></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 form-group">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 form-group">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4 form-group">
                                                                                            <span class="font-weight-bold font-size-lg" id="name_coordinacion"></span>
                                                                                        </div>
                                                                                        <div class="col-sm-8 form-group">
                                                                                            <span class="btn btn-sm badge" id="firm_coordinacion"  data-idempleado="" data-nuevafirma="" ></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    </br>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4 form-group">
                                                                                            <span class="font-weight-bold font-size-lg">Planeacion de Proyectos:</span>
                                                                                        </div>
                                                                                        <div class="col-sm-4 form-group">
                                                                                            <span class="btn btn-sm badge" id="firm_planeacion" data-idempleado="" data-nuevafirma="" onclick="firma_solicitud()"></span>
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
                                                                        <table id="tabla_pedidos" class="table datatable-scroll-y tabla-reslta-row-hover" cellspacing="0" width="100%" data-folio=""><!--Id Coordinador = 1 Test, 2 Swab-->
                                                                            <col width="5%">
                                                                            <col width="3%">
                                                                            <col width="35%">
                                                                            <col width="32%">
                                                                            <col width="25%">
                                                                            <thead>
                                                                              <tr>
                                                                                <th>Cantidad</th> <!-- 0 -->
                                                                                <th></th> <!-- 1 -->
                                                                                <th>Articulo</th> <!-- 2 -->
                                                                                <th>Motivo del requerimiento</th> <!-- 3 -->
                                                                                <th>Comentarios</th> <!-- 4 -->
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
                                                <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="guardarCambios()" title="Salir del formulario" id="guarda_cambios_solicitud">Almacen</button>
                                                <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="guardarCambios()" title="Salir del formulario" id="guarda_cambios_solicitud">Guardar</button>
                                                <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="closeModalSolicitudDetail()" title="Salir del formulario">Salir</button>
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="tabla_visor_solicitudes">
                                            <div class="table-responsive" id="content_table_pedidos_list" data-scroll="">
                                                <table class="table table-xs" id="lay_out_solicitudesx" cellspacing="0" width="100%" data-idcoordinacion="4">
                                                    <col width="25%">
                                                    <col width="20%">
                                                    <col width="35%">
                                                    <col width="20%">
                                                    <thead>
                                                        <tr>
                                                            <th>Equipo</th> <!-- 4 -->
                                                            <th>Status</th> <!-- 4 -->
                                                            <th>Materiales solicitados</th> <!-- 3 -->
                                                            <th>Fecha</th> <!-- 2 -->
                                                        </tr>
                                                    </thead>
                                                    <tbody data-link="row" class="rowlink">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /left content -->
                                    <div class="sidebar-sticky w-100 w-md-auto order-1 order-md-2" id="sidebar_sticky" style="display: none;">
                                        <div class="sidebar sidebar-light sidebar-component sidebar-component-right sidebar-expand-md">
                                            <div class="sidebar-content">
                                                <div class="card">
                                                    <div class="card-header header-elements-inline bg-white">
                                                        <h6 class="card-title"><i class="icon-comment-discussion mr-2 icon-1x text-danger-800"></i> Comentarios</h6>
                                                        <div class="header-elements">
                                                            <div class="list-icons">
                                                                <a class="list-icons-item" onclick="closeCardComent()"><i class="icon-cross2"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" id="scrollxy" style="overflow-y: scroll; height:400px;">
                                                        <ul class="media-list media-chat mb-3" id="conent_coment_area">
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control border-right-0" placeholder="Agregar comentario..." onkeyup="mayus(this);" maxlength="140" id="text_comentario" data-idpedido="">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-sm alpha-primary text-primary-800" type="button" onclick="send_comentario()"><i class="icon-paperplane"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-sticky w-100 order-1 order-md-2" id="sidebar_sticky_article">
                                        <div class="sidebar sidebar-light sidebar-component sidebar-component-right sidebar-expand-md w-100">
                                            <div class="sidebar-content">
                                                <div class="card">
                                                    <div class="card-header header-elements-inline bg-white">
                                                        <h6 class="card-title"><i class="icon-comment-discussion mr-2 icon-1x text-danger-800"></i> Comentarios</h6>
                                                        <div class="header-elements">
                                                            <div class="list-icons">
                                                                <a class="list-icons-item" onclick="closeCardComent()"><i class="icon-cross2"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive" id="content_table_pedidos_list" data-scroll="">
                                                            <table class="table table-xs" id="search_article" cellspacing="0" width="100%">
                                                                <col width="80%">
                                                                <col width="20%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Articulo</th> <!-- 4 -->
                                                                        <th>Cant.</th> <!-- 4 -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody data-link="row" class="rowlink">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- /inner container -->
                    <!-- /large modal -->
                    <div id="mod_log_acces" class="modal fade" tabindex="-1" data-firmax="4" style="display: none;">
                        <div class="modal-dialog modal-xs">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Login form -->
                                    <div class="text-center mb-3">
                                        <img src="../../global_assets/images/placeholders/Imagen4.jpg" class="img-fluid" width="120" height="50">
                                        <h5 class="mb-0">AUTENTIFICAR</h5>
                                    </div>
                                    <form autocomplete="off" id="form_log_autentic">
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
                    <!-- Area modal -->
                    <div id="modal_large" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-idequipo="" data-folio="">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form id="add_articulo">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                                        <select data-placeholder="Buscar articulo en catálogo de Almacen..." class="form-control select-minimum" data-fouc name='articulo_cod' id="select_article">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-blue-800 text-center" id="cod_articulo" readonly placeholder="Codigo articulo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                  <div class="form-group form-group-feedback form-group-feedback-left">
                                                      <input type="text" class="form-control text-blue-800 pickadate-accessibility" id="fecharequerimiento" placeholder="Fecha de Requerimiento">
                                                      <div class="form-control-feedback form-control-feedback-sm">
                                                          <i class="icon-calendar22"></i>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="number" class="form-control text-danger-800 text-center font-weight-bold" step="1" value="1" min="0" id="cantidad" value="0" required="true" title="Cantidad a solicitar">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select data-placeholder="Unidad" name="select" class="form-control form-control-select2 text-right select" id="unidad">
                                                        <option></option>
                                                        <option value="pza">Pieza</option>
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
                                            </div>
                                          </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control text-blue-800" id="descripcion" required="true" placeholder="Descripción del articulo" onkeyup="mayus(this);">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-file-text"></i>
                                                    </div>
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
                                        
                                        <div class="row">    
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control text-blue-800" id="justificacion" required="true" onkeyup="mayus(this);" placeholder="Motivo del requerimiento">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-help"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="resetModal()" title="Limpiar formulario"><i class="icon-eraser2"></i></button>
                                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="resetModalPedido()" title="Limpiar formulario">Salir</button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="savePedidoModal()" title="Agregar">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
		</div>
                <!-- /main content -->
                <!-- Footer -->
                <?php include "../bar_nav/footer_navbar.php"; ?>
                <!-- /footer -->     
            </div>
            <!-- /page content -->
    </body>
</html>
