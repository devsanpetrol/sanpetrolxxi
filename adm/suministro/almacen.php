<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SANPETROL XXI - Almacén</title>

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
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_popups.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <script src="js/engineJS_7.js"></script>
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
                        <!-- Bottom right menu -->
                        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click">
                            <li>
                                <a class="fab-menu-btn btn bg-success-400 btn-float rounded-round btn-icon">
                                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                                    <i class="fab-icon-close icon-cross2"></i>
                                </a>
                                <ul class="fab-menu-inner">
                                    <li>
                                        <div data-fab-label="Nuevo Articulo o Material">
                                            <button type="button" class="btn btn-outline bg-primary rounded-round btn-icon btn-sm btn-float" onclick="article_new()"><i class="icon-pencil"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- /bottom right menu -->
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datatable-basic text-nowrap" id="almacen_tabla" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Articulo</th>
                                                <th>Stock</th>
                                                <th>Min</th>
                                                <th>Max</th>
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
                    <!-- Area modal -->
                    <div id="modal_inventario" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-sm-4 form-group form-group-feedback-right text-center">
                                            <label class="font-weight-bold">Codigo</label>
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-center" id="old_cod_articulo" readonly>
                                        </div>
                                        <div class="col-sm-8 form-group form-group-feedback-right text-center">
                                            <label class="font-weight-bold">Articulo</label>
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-center" id="descripcion" readonly>
                                        </div>
                                        <div class="col-sm-12 form-group form-group-feedback-right text-center">
                                            <table class="table datatable-basic text-nowrap table-xs" id="dt_for_inventario" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Codigo</th>
                                                        <th>Unidad</th>
                                                        <th>No. Serie</th>
                                                        <th>No. Inventario</th>
                                                        <th>Costo</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline bg-danger-300 rounded-round btn-icon ml-2 btn-sm" onclick="salir()"><i class="icon-exit2"></i> Salir</button>
                                    <button type="button" class="btn btn-outline bg-slate rounded-round btn-icon ml-2 btn-sm"><i class="icon-download4"></i> Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /large modal -->
                    <!-- Modal new invoice -->
                    <div id="article_new" class="modal fade">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-menu7 mr-2"></i> PROPIEDADES DEL ARTICULO</legend>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_codigobarra" placeholder="Codigo de barra">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-barcode2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_cod_inventario" readonly placeholder="SKU.">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-price-tag2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-bold text-blue-800" id="new_descripcion" placeholder="Descripción *" onkeyup="mayus(this);">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-file-text"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <select data-placeholder="Categoria *" class="form-control form-control-select2 border-danger text-right" id="select_categoria" data-fouc>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <select data-placeholder="Tipo de unidad *" class="form-control form-control-select2 text-right" id="new_tipounidad">
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
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_especificacion" placeholder="Especificación">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-design"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_marca" placeholder="Marca *">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-stamp"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger border-0 alert-dismissible" id="msj_alert1" style="display: none;">
                                                            <button type="button" class="close" onclick="close_alert()"><span>×</span></button>
                                                            <span class="font-weight-semibold">Error! </span> Debe completar el formulario <a href="#" class="alert-link" onclick="close_alert()">Intentar nuevamente</a>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-bookmark mr-2"></i> ALMACÉN</legend>
                                                <input type="hidden" id="new_idarticulo" value="">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_stock" readonly placeholder="Stock" title="Stock disponible en Almacén">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-book2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_min" placeholder="Min." title="Cantidad Mínima">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-chevron-down text-danger-600"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_max" placeholder="Max." title="Cantidad Máxima">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-chevron-up text-blue-700"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_ubicacion" placeholder="Ubicación en el almacen" title="Ubicación fisica del articulo en el Almacén">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-target2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-transparent">
                                    <label><input type="checkbox" value="" id="new_salida_rapida"> Salida Rapida</label>
                                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="cerrarArticle()">CERRAR</button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="updArticle()">GUARDAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
                    <!-- Modal new invoice -->
                    <div id="add_article" class="modal fade">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-pencil5 mr-2"></i> NUEVO ARTICULO</legend>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 add-new-art" id="add_codigobarra" placeholder="Codigo de barra">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-barcode2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 add-new-art" id="add_cod_inventario" readonly placeholder="Codigo Inv.">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-price-tag2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <select data-placeholder="Categoria *" class="form-control form-control-select2 border-danger text-right select-new-article" id="select_categoria_2" data-fouc>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <select data-placeholder="Tipo de unidad *" class="form-control form-control-select2 text-right select-new-article" id="add_tipounidad">
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
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 add-new-art" id="add_descripcion" placeholder="Descripción *" onkeyup="mayus(this);">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-file-text"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 add-new-art" id="add_especificacion" placeholder="Especificación">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-design"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 add-new-art" id="add_marca" placeholder="Marca *">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-stamp"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger border-0 alert-dismissible" id="msj_alert3" style="display: none;">
                                                            <button type="button" class="close" onclick="close_alert()"><span>×</span></button>
                                                            <span class="font-weight-semibold">Error! </span> Debe completar el formulario <a href="#" class="alert-link" onclick="close_alert()">Intentar nuevamente</a>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-transparent">
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" id="new_agregarusar" onclick="addArticle(true)">GUARDAR Y APLICAR</button>
                                    <div class="list-icons text-danger-800">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" data-toggle="dropdown"><i class="icon-menu5"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right bg-slate-600">
                                                <a class="dropdown-item" onclick="limpiar_form()"><i class="icon-eraser2"></i> LIMPIAR FORMULARIO</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" onclick="salir_sin_guardar()"><i class="icon-cross2"></i> SALIR SIN GUARDAR</a>
                                            </div>
                                        </div>
                                    </div>
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
