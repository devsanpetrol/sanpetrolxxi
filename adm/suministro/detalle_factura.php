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
    <script src="js/engineJS_1.js"></script>
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
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light"></div>

            <!-- Content area -->
            <div class="content">
                <!-- New Invoice -->
                <div class="card card-new-invoice" >
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
                    <form action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>
                                <legend class="font-weight-semibold text-danger-800"><i class="icon-truck mr-2"></i> DATOS DE PROVEEDOR</legend>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="rfc" placeholder="R.F.C." required>
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-shield-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="codigopostal" placeholder="Codigo Postal">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-mailbox"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="nombreempresa" placeholder="Nombre Fiscal de la empresa" onkeyup="mayus(this);">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-office"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="domicilioempresa" placeholder="Domicilio Fiscal">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-pin-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="telefono" placeholder="Teléfonos">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="correo" placeholder="E-Mail">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-envelop"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                            <legend class="font-weight-semibold text-danger-800"><i class="icon-reading mr-2"></i> DATOS DE DOCUMENTO</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 pickadate-accessibility" id="fechaemision" placeholder="Fecha de Emisión">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-calendar22"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="seriefolio" placeholder="Serie - Folio">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-price-tag2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="lugaremision" placeholder="Lugar de Emisión">
                                            <div class="form-control-feedback form-control-feedback-sm">
                                                <i class="icon-stamp"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="uuid" placeholder="U.U.I.D.">
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
                                                <input type="text" class="form-control text-right font-weight-bold" id="total" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="font-weight-semibold text-danger-800"><i class="icon-pen-plus mr-2"></i> NUEVO DETALLE DE ARTICULO <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple btn-icon ml-1" title="Nuevo articulo"><i class="icon-clippy"></i></button></legend>
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
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_codigoinventario" placeholder="Codigo de Inventario">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 input-newarticle" id="i_descripcion" placeholder="Descripción">
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
                                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple btn-icon ml-1" onclick="addElementToTable()"><i class="icon-add-to-list"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-xs" id="table_inventarioitems">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Description</th>
                                        <th>Cantidad</th>
                                        <th>P. Unidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                </div>
                <div class="card-footer bg-transparent text-right">
                    <button type="button" class="btn btn-sm alpha-slate text-slate-800 legitRipple" onclick="clearDatatable()"><i class="icon-eraser2"></i></button>
                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="hide_showNewInvoice()">Cerrar</button>
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
                                <button type="button" class="btn btn-sm btn-outline bg-primary text-primary-800 rounded-round btn-icon ml-2" title="Nueva factura" onclick="hide_showNewInvoice()"><i class="icon-plus3"></i></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive-sm table-xs dt-responsive" id="datatable_invoice_detail">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Period</th>
                                <th>Proveedro</th>
                                <th>Issue date</th>
                                <th>Due date</th>
                                <th>Amount</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#0025</td>
                                <td>February 2015</td>
                                <td>
                                    <h6 class="mb-0">
                                        <a href="#">Rebecca Manes</a>
                                        <span class="d-block font-size-sm text-muted">Payment method: Skrill</span>
                                    </h6>
                                </td>
                                
                                <td>
                                    April 18, 2015
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid on Mar 16, 2015</span>
                                </td>
                                <td>
                                    <h6 class="mb-0 font-weight-bold">$17,890</h6>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons list-icons-extended">
                                        <a href="#" class="list-icons-item" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a>
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-file-download"></i> Download</a>
                                                <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit</a>
                                                <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#0024</td>
                                <td>February 2015</td>
                                <td>
                                    <h6 class="mb-0">
                                        <a href="#">James Alexander</a>
                                        <span class="d-block font-size-sm text-muted">Payment method: Wire transfer</span>
                                    </h6>
                                </td>
                                
                                <td>
                                    April 17, 2015
                                </td>
                                <td>
                                    <span class="badge badge-warning">5 days</span>
                                </td>
                                <td>
                                    <h6 class="mb-0 font-weight-bold">$2,769</h6>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons list-icons-extended">
                                        <a href="#" class="list-icons-item" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a>
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-file-download"></i> Download</a>
                                                <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit</a>
                                                <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#0023</td>
                                <td>February 2015</td>
                                <td>
                                    <h6 class="mb-0">
                                        <a href="#">Jeremy Victorino</a>
                                        <span class="d-block font-size-sm text-muted">Payment method: Payoneer</span>
                                    </h6>
                                </td>
                                
                                <td>
                                    April 17, 2015
                                </td>
                                <td>
                                    <span class="badge badge-primary">27 days</span>
                                </td>
                                <td>
                                    <h6 class="mb-0 font-weight-bold">$1,500</h6>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons list-icons-extended">
                                        <a href="#" class="list-icons-item" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a>
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-file-download"></i> Download</a>
                                                <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit</a>
                                                <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#0022</td>
                                <td>January 2015</td>
                                <td>
                                    <h6 class="mb-0">
                                        <a href="#">Margo Baker</a>
                                        <span class="d-block font-size-sm text-muted">Payment method: Paypal</span>
                                    </h6>
                                </td>
                                <td>
                                    January 15, 2015
                                </td>
                                <td>
                                    <span class="badge badge-primary">12 days</span>
                                </td>
                                <td>
                                    <h6 class="mb-0 font-weight-bold">$4,580</h6>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons list-icons-extended">
                                        <a href="#" class="list-icons-item" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a>
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-file-download"></i> Download</a>
                                                <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit</a>
                                                <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
                                                <ul class="list list-unstyled mb-0">
                                                    <li>Fecha Emision: <span class="font-weight-semibold">January 12, 2015</span></li>
                                                    <li>Lugar Emision: <span class="font-weight-semibold">London E1 8BF</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex flex-md-wrap">
                                    <div class="mb-4 mb-md-2">
                                        <span class="text-muted">Datos del emisor</span>
                                        <ul class="list list-unstyled mb-0">
                                            <li><h5 class="my-2">SURTIDO DE PERSIANAS SA DE CV</h5></li>
                                            <li><span class="font-weight-semibold">SPER78623G9H</span></li>
                                            <li>3 Goodman Street</li>
                                            <li>London E1 8BF, United Kingdom</li>
                                            <li>888-555-2311</li>
                                            <li><a href="#">rebecca@normandaxis.ltd</a></li>
                                        </ul>
                                    </div>
                                    <div class="mb-2 ml-auto">
                                        <span class="text-muted">Payment Details:</span>
                                        <div class="d-flex flex-wrap wmin-md-400">
                                            <ul class="list list-unstyled mb-0">
                                                <li><h5 class="my-2">Total Due:</h5></li>
                                                <li>Numero serie</li>
                                                <li>UUID</li>
                                            </ul>
                                            <ul class="list list-unstyled text-right mb-0 ml-auto">
                                                <li><h5 class="font-weight-semibold my-2">$8,750</h5></li>
                                                <li><span class="font-weight-semibold">DFU-4567</span></li>
                                                <li><span class="font-weight-semibold">4A1B43E2-1183-4AD4-A3DE-C2DA787AE56A</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-xs">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Cantidad</th>
                                        <th>P. Unidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 font-weight-semibold">Create UI design model</h6>
                                            
                                        </td>
                                        <td>7</td>
                                        <td>$57</td>
                                        <td><span class="font-weight-semibold">$3,990</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 font-weight-semibold">Support tickets list doesn't support commas</h6>
                                            
                                        </td>
                                        <td>2</td>
                                        <td>$12</td>
                                        <td><span class="font-weight-semibold">$840</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 font-weight-semibold">Fix website issues on mobile</h6>
                                            
                                        </td>
                                        <td>70</td>
                                        <td>$200</td>
                                        <td><span class="font-weight-semibold">$2,170.00</span></td>
                                    </tr>
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
                                                    <th>Subtotal:</th>
                                                    <td class="text-right">$7,000.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td class="text-right text-primary"><h5 class="font-weight-semibold">$7,000.00</h5></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" data-dismiss="modal">Close</button>
                        </div>
                    </div>
            </div>
    </div>
    <!-- /modal with invoice -->
    <!-- Modal new invoice -->
    <div id="invoice_new" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Datos del Proveedor</legend>
                                    <div class="form-group">
                                        <label>Enter your name:</label>
                                        <input type="text" class="form-control" placeholder="Eugene Kopyov">
                                    </div>
                                    <div class="form-group">
                                        <label>Enter your password:</label>
                                        <input type="password" class="form-control" placeholder="Your strong password">
                                    </div>
                                    <div class="form-group">
                                        <label>Select your state:</label>
                                        <select data-placeholder="Select your state" class="form-control form-control-select2" data-fouc>
                                            <option></option>
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone">
                                                <option value="CA">California</option>
                                                <option value="NV">Nevada</option>
                                                <option value="WA">Washington</option>
                                            </optgroup>
                                            <optgroup label="Mountain Time Zone">
                                                <option value="AZ">Arizona</option>
                                                <option value="CO">Colorado</option>
                                                <option value="WY">Wyoming</option>
                                            </optgroup>
                                            <optgroup label="Central Time Zone">
                                                <option value="AL">Alabama</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="KY">Kentucky</option>
                                            </optgroup>
                                            <optgroup label="Eastern Time Zone">
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="WV">West Virginia</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Attach screenshot:</label>
                                        <input type="file" class="form-input-styled" data-fouc>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Datos de Factura</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name:</label>
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Try me&hellip;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name:</label>
                                                <input type="text" placeholder="Kopyov" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input type="text" placeholder="eugene@kopyov.com" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone #:</label>
                                                <input type="text" placeholder="+99-99-9999-9999" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <select data-placeholder="Select your country" class="form-control form-control-select2" data-fouc>
                                                    <option></option>
                                                    <option value="Cambodia">Cambodia</option> 
                                                    <option value="Cameroon">Cameroon</option> 
                                                    <option value="Canada">Canada</option> 
                                                    <option value="Cape Verde">Cape Verde</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State/Province:</label>
                                                <input type="text" placeholder="Bayern" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>ZIP code:</label>
                                                <input type="text" placeholder="1031" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>City:</label>
                                                <input type="text" placeholder="Munich" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address line:</label>
                                                <input type="text" placeholder="Ring street 12" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-transparent">
                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal with invoice -->
</body>
</html>
