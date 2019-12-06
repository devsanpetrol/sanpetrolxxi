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
    <!-- Theme JS files -->
    <script src="js/engineJS_1.js"></script>
    <script src="../../assets/js/app.js"></script>
    <script src="../../global_assets/js/demo_pages/invoice_archive.js"></script>
    
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
                <!-- Invoice archive -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title">Información de Facturas</h6>
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
            <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Invoice #49029</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <ul class="list list-unstyled mb-0">
                                                <li>2269 Elba Lane</li>
                                                <li>Paris, France</li>
                                                <li>888-555-2311</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <div class="text-sm-right">
                                                <h4 class="text-primary mb-2 mt-md-2">Invoice #49029</h4>
                                                <ul class="list list-unstyled mb-0">
                                                    <li>Date: <span class="font-weight-semibold">January 12, 2015</span></li>
                                                    <li>Due date: <span class="font-weight-semibold">May 12, 2015</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex flex-md-wrap">
                                    <div class="mb-4 mb-md-2">
                                        <span class="text-muted">Invoice To:</span>
                                        <ul class="list list-unstyled mb-0">
                                            <li><h5 class="my-2">Rebecca Manes</h5></li>
                                            <li><span class="font-weight-semibold">Normand axis LTD</span></li>
                                            <li>3 Goodman Street</li>
                                            <li>London E1 8BF</li>
                                            <li>United Kingdom</li>
                                            <li>888-555-2311</li>
                                            <li><a href="#">rebecca@normandaxis.ltd</a></li>
                                        </ul>
                                    </div>
                                    <div class="mb-2 ml-auto">
                                        <span class="text-muted">Payment Details:</span>
                                        <div class="d-flex flex-wrap wmin-md-400">
                                            <ul class="list list-unstyled mb-0">
                                                <li><h5 class="my-2">Total Due:</h5></li>
                                                <li>Bank name:</li>
                                                <li>Country:</li>
                                                <li>City:</li>
                                                <li>Address:</li>
                                                <li>IBAN:</li>
                                                <li>SWIFT code:</li>
                                            </ul>
                                            <ul class="list list-unstyled text-right mb-0 ml-auto">
                                                <li><h5 class="font-weight-semibold my-2">$8,750</h5></li>
                                                <li><span class="font-weight-semibold">Profit Bank Europe</span></li>
                                                <li>United Kingdom</li>
                                                <li>London E1 8BF</li>
                                                <li>3 Goodman Street</li>
                                                <li><span class="font-weight-semibold">KFH37784028476740</span></li>
                                                <li><span class="font-weight-semibold">BPT4E</span></li>
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
                                        <td><span class="font-weight-semibold">$2,170</span></td>
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
                                                    <td class="text-right">$7,000</td>
                                                </tr>
                                                <tr>
                                                    <th>Iva: <span class="font-weight-normal">(16%)</span></th>
                                                    <td class="text-right">$1,750</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td class="text-right text-primary"><h5 class="font-weight-semibold">$8,750</h5></td>
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
</body>
</html>
