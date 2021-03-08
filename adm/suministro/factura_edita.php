<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include '../../bar_nav/title.php'; ?> - Reporte de Entrada de Material a Almacén</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
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
    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="../../assets/js/app.js"></script>
    <!-- /theme JS files -->
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="../../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <!-- Theme JS files -->
    
   
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/tables/datatables/datatables/datatables.js"></script>
    <script src="../../global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <!-- Theme JS files -->
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <!-- Theme JS files -->
    <script src="js/engineJS_26.js"></script>
    <!--<script src="js/ini_menu_almacen.js"></script>-->
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>    
    <!-- /theme JS files -->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
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
                    <div class="content">
	<!-- Right content -->
        <div class="w-100">
	<!-- /COL-MD-10 TABLA CONTENIDO -->
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <h4 class="card-title">EDITAR DOCUMENTO</h4>
                    <button type="button" class="btn bg-grey daterange-ranges fecha-rango">
                    <i class="icon-calendar22 mr-2"></i>
                    <span></span>
                </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable-basic text-nowrap" id="almacen_tabla" style="width:100%">
                            <col width="10%">
                            <col width="5%">
                            <col width="50%">
                            <col width="20%">
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cod. Articulo</th>
                                    <th>Articulo</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>Unidad</th>
                                    <th>Precio/Unidad</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- /COL-MD-10 TABLA CONTENIDO -->
        </div>
                </div>
                <!-- /content area -->
                <!-- Modal with invoice -->
                <div id="invoice" class="modal fade">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <div class="text-sm-right">
                                                    <h4 class="text-primary mb-2 mt-md-2">DETALLE DEL DOCUMENTO</h4>
                                                    <span class="text-muted">Archivado: </span><span class="text-muted" id="view_date_insert"></span>
                                                    <ul class="list list-unstyled mb-0">
                                                        <li>Fecha Emision: <span class="font-weight-semibold" id="view_fecha_emision"></span></li>
                                                        <li>Lugar Emision: <span class="font-weight-semibold" id="view_lugar_emision"></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-md-wrap">
                                        <div class="col-md-6">
                                            <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Detalles del Proveedor</legend>
                                            <ul class="list list-unstyled mb-0">
                                                <li><h5 class="my-2 font-weight-semibold" id="view_nombre"></h5></li>
                                                <li><span class="font-weight-semibold" id="view_rfc"></span></li>
                                                <li id="view_direccion"></li>
                                                <li id="view_num_telefono"></li>
                                                <li class="text-blue-800" id="view_email"></li>
                                                <li class="text-blue-800" id="view_pagina_web"></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="font-weight-semibold"><i class="icon-file-text mr-2"></i> Detalles del Pago</legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Número Serie</label>
                                                    <div class="col-lg-6"><input id="view_serie_folio" type="text" class="form-control text-blue-800 text-uppercase"></div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Tipo de Documento</label>
                                                    <div class="col-lg-6">
                                                        <select data-placeholder="Select your country" class="form-control select-fixed-single" id="view_tipo_documento" data-fouc>
                                                            <option value="factura">FACTURA</option>
                                                            <option value="ticket">NOTA SENCILLA</option>
                                                            <option value="cotizacion">COTIZACIÓN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs" id="table_DetailDocumento">
                                        <col width="44%">
                                        <col width="12%">
                                        <col width="12%">
                                        <col width="12%">
                                        <col width="15%">
                                        <col width="5%">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Cantidad</th>
                                                <th>Unidad</th>
                                                <th>Precio/Unidad</th>
                                                <th class="text-right">Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="font-weight-semibold">Observación:</label>
                                                <textarea id="view_observacion" rows="5" cols="5" class="form-control text-blue-800" placeholder="Escriba aqui las observaciones..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-md-flex flex-md-wrap">
                                                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                                    <div class="table-responsive">
                                                        <table class="table table-xs">
                                                            <tbody>
                                                                <tr>
                                                                    <th></th>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total:</th>
                                                                    <td class="text-right text-primary"><h5 class="font-weight-semibold text-blue-800" id="view_total"></h5></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer bg-transparent">
                                <button type="button" class="btn btn-sm btn-danger legitRipple" onclick="eliminarFactura()" id="id_factura_" data-idfactura="">Elimiar</button>
                                <button type="button" class="btn btn-sm btn-primary legitRipple" onclick="guardaCostoUnitario()">Guardar</button>
                                <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="exitDetailFactura()">salir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /modal with invoice -->
                <input type="hidden" id="filtro_fecha_inicio">
                <input type="hidden" id="filtro_fecha_fin">
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
