<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="es">
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
    
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script src="../../global_assets/js/main/jquery.min.js"></script>
    <script src="../../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="../../global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/anytime.min.js"></script>

    <script src="../../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="../../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="js/engineJS_1.32.js"></script>
    <script src="js/sum().js"></script>
    <script src="../../assets/js/app.js"></script>
    <!-- /theme JS files -->
</head>
<body>
    <!-- Main navbar -->
    <?php include '../bar_nav/main_navbar.php'; ?>
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <?php include '../bar_nav/main_sidebar.php'; ?>
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
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light"></div>

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
                                    <div data-fab-label="Nuevo Articulo">
                                        <a href="#" class="btn bg-primary rounded-round btn-icon btn-float legitRipple" data-toggle="modal" data-target="#article_new">
                                            <i class="icon-pen-plus"></i>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div data-fab-label="Buscar Proveedor">
                                        <a href="#" data-toggle="modal" data-target="#busca_proveedor" class="btn bg-primary rounded-round btn-icon btn-float legitRipple">
                                            <i class="icon-truck"></i>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div data-fab-label="Nuevo Documento">
                                        <a href="#" class="btn bg-primary rounded-round btn-icon btn-float legitRipple" onclick="finishDocument2()">
                                            <i class="icon-file-plus"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                </ul>
                <!-- New Invoice -->
                <div class="card card-new-invoice" style="display: none">
                    <!--<div class="card-header bg-transparent header-elements-inline">style="display: none"
                        <h6 class="card-title">Ingreso de Articulo</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <div class="ml-3">
                                        <h6 class="font-weight-semibold mb-0 text-blue-800" ></h6>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline bg-danger text-danger-800 rounded-round btn-icon ml-2" title="Cerrar"><i class="icon-minus2"></i></button>
                            </div>
                        </div>
                    </div>-->
                    <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                                <fieldset>
                                <legend class="font-weight-semibold text-danger-800"><i class="icon-truck mr-2"></i> DATOS DE PROVEEDOR </legend>
                                <form action="" id="form_proveedor">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="rfc" placeholder="R.F.C." data-idproveedor="0" readonly>
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-shield-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="nombreempresa" placeholder="Nombre de la empresa" readonly>
                                            <div class="form-control-feedback form-control-feedback-lg">
                                                <i class="icon-add text-pink-800" data-toggle="modal" data-target="#busca_proveedor" style="cursor: pointer" title="Buscar/Agregar proveedor" ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> DATOS DEL DOCUMENTO </legend>
                            <form action="" id="form_documento">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 pickadate-accessibility" data-value="2015/04/20" id="add_fecha_emision" placeholder="Fecha de Emisión">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-calendar22"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="add_serie_folio" placeholder="Serie - Folio">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-price-tag2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="add_lugar_emision" placeholder="Lugar de Emisión" onkeyup="mayus(this);">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-stamp"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left d-none">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="add_uuid" placeholder="U.U.I.D.">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-embed"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label text-danger-800 font-weight-bold">TOTAL:</label>
                                            <div class="col-lg-9">
                                                <button type="button" class="btn alpha-blue text-right text-blue-800 font-weight-semibold border-blue-600 legitRipple btn-block" id="total" data-total="0">0</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </fieldset>
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
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_codigoinventario" placeholder="Codigo de Inventario">
                                            <div class="form-control-feedback form-control-feedback-lg">
                                                <i class="icon-square-up-right text-pink-800" data-toggle="modal" data-target="#busca_articulo" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_descripcion" readonly placeholder="Descripción">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_cantidad" placeholder="Cantidad">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_preciounidad" placeholder="P/Unidad">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-primary legitRipple btn-icon ml-1" onclick="addElementToTable()" title="Agregar"><i class="icon-add-to-list"></i></button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-xs" id="table_inventarioitems" style="width: 100%">
                                    <col width="15%">
                                    <col width="45%">
                                    <col width="15%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Description</th>
                                            <th>Cantidad</th>
                                            <th>Precio/Unidad</th>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" title="Eliminar selección" id="delsel"><i class="icon-bin"></i></button>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer bg-transparent text-right">
                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="clearDatatable()" title="Limpiar tabla"><i class="icon-eraser2"></i></button>
                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="hide_showNewInvoice()">Cerrar</button>
                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple btn-icon" onclick="add_documento()">Guardar</button>
                </div>
                </div>
                <!-- Invoice archive -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title">Información de Facturas</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <div class="ml-3">
                                        <h6 class="font-weight-semibold mb-0 text-blue-800" ></h6>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline bg-primary text-primary-800 rounded-round btn-icon ml-2" title="Nuevo documento de compra" onclick="hide_showNewInvoice()"><i class="icon-plus3"></i></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive-sm table-xs dt-responsive" id="datatable_invoice_detail" style="width: 100%">
                        <col width="5%">
                        <col width="15%">
                        <col width="30%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periodo</th>
                                <th>Proveedor</th>
                                <th>Serie-Folio</th>
                                <th>Fecha emisión</th>
                                <th>Total</th>
                                <th class="text-center">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /invoice archive -->
            </div>
            <!-- Footer -->
            <?php include '../bar_nav/footer_navbar.php'; ?>
            <!-- /footer -->
        </div>
    </div>
    <!-- Modal with invoice -->
    <div id="invoice" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <div class="text-sm-right">
                                        <h4 class="text-primary mb-2 mt-md-2">DETALLE FACTURA</h4>
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
                            <div class="mb-4 mb-md-2">
                                <span class="text-muted">Datos del emisor</span>
                                <ul class="list list-unstyled mb-0">
                                    <li><h5 class="my-2" id="view_nombre"></h5></li>
                                    <li><span class="font-weight-semibold" id="view_rfc"></span></li>
                                    <li id="view_direccion"></li>
                                    <li id="view_num_telefono"></li>
                                    <li class="text-blue-800" id="view_email"></li>
                                    <li class="text-blue-800" id="view_pagina_web"></li>
                                </ul>
                            </div>
                            <div class="mb-2 ml-auto">
                                <span class="text-muted">Detalles del pago:</span>
                                <div class="d-flex flex-wrap wmin-md-400">
                                    <ul class="list list-unstyled mb-0">
                                        <li>Numero serie</li>
                                        <li>UUID</li>
                                    </ul>
                                    <ul class="list list-unstyled text-right mb-0 ml-auto">
                                        <li><span class="font-weight-semibold" id="view_serie_folio"></span></li>
                                        <li><span class="font-weight-semibold" id="view_uuid"></span></li>
                                    </ul>
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
                        <col width="20%">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Precio/Unidad</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
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
                <div class="modal-footer bg-transparent">
                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="exitDetailFactura()">salir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal with invoice -->
    <!-- Modal new article_new -->
    <div id="article_new" class="modal fade">
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
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_codigobarra" placeholder="Codigo de barra">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-barcode2"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_cod_inventario" readonly placeholder="Codigo Inv.">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-price-tag2"></i>
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
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_descripcion" placeholder="Descripción *" onkeyup="mayus(this);">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-file-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="display: none;">
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-transparent">
                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" id="new_agregarusar" onclick="addArticle(true)">GUARDAR Y APLICAR</button>
                    <div class="list-icons text-danger-800">
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" data-toggle="dropdown"><i class="icon-menu5"></i></button>
                            <div class="dropdown-menu dropdown-menu-right bg-slate-600">
                                <a class="dropdown-item" onclick="addArticle(false)"><i class="icon-floppy-disk"></i> GUARDAR Y SALIR</a>
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
    <!-- Modal with busca_proveedor -->
    <div id="busca_proveedor" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="table-responsive">
                    <table class="table table-xs table-border-dashed datatable-basic text-nowrap" id="proveedor_tabla_aplica" style="width:100%">
                        <col width="70%">
                        <col width="30%">
                        <col width="10%">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>R.F.C.</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
                <div class="modal-footer bg-transparent">
                    <button type="button" class="btn btn-sm btn-warning legitRipple" id="btnmouestranewpro" onclick="hide_showNewProveedor()" title="Agregar nuevo proveedor"><i class="icon-plus3"></i></button>
                    <button type="button" class="btn btn-sm btn-success legitRipple" onclick="ref_proveedor_tabla_aplica()" title="Refrescar tabla"><i class="icon-rotate-cw3"></i></button>
                    <button type="button" class="btn btn-sm btn-primary legitRipple" onclick="hide_showModalNewProv()">salir</button>
                </div>
                <div class="card-body" id="cardnewprov" style="display: none">
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
                                        <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="hide_showNewProveedor()" title="Cerrar"><i class="icon-cross2"></i></button>
                                        <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="guarda_new_prov()" title="Guardar"><i class="icon-checkmark3"></i></button>
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
    <!-- Modal with busca_articulo -->
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
                    <button type="button" class="btn btn-sm btn-success legitRipple" onclick="actualizarTablaItem()" title="Refrescar tabla"><i class="icon-rotate-cw3"></i></button>
                    <button type="button" class="btn btn-sm btn-primary legitRipple" onclick="hide_showModalNewArt()">salir</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /modal with invoice -->
</body>
</html>
