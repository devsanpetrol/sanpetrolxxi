<?php require_once "../../ini_ses.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include "../../bar_nav/title.php"; ?></title>
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
    <!-- /core JS files -->
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
    <script src="js/engineJS_4.js"></script>
    
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
<body>
    <!-- Main navbar -->
    <?php include "../bar_nav/main_navbar.php"; ?>
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <?php include "../bar_nav/main_sidebar.php"; ?>
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light"></div>

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
            <!-- Filter toolbar -->
            <div class="navbar navbar-expand-lg navbar-light navbar-component rounded">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
                        <i class="icon-unfold mr-2"></i>
                        Filtros
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-filter">
                    <ul class="navbar-nav flex-wrap mr-3">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="icon-drawer-in"></i>
                                Bandeja de entrada
                                <span class="badge bg-success badge-pill ml-auto" id="total_pedidos_mostrado">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="icon-drawer-out"></i> Mis solicitudes enviadas</a>
                        </li>
                    </ul> 
                </div>
                
            </div>            
            <!-- Right content -->
            <div class="flex-fill overflow-auto">
                <!-- Single line -->
                <div class="card" id="tabla_visor_solicitudes">
                    <!-- Table -->
                    <div class="table-responsive" id="content_table_pedidos_list" data-scroll="">
                        <table class="table table-inbox" id="lay_out_solicitudesx" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="table-inbox-attachment text-center">Revisado</th> <!-- 4 -->
                                    <th class="table-inbox-name">Folio</th> <!-- 0 -->
                                    <th class="table-inbox-message">Materiales solicitados</th> <!-- 3 -->
                                    <th class="table-inbox-time">Fecha</th> <!-- 4 -->
                                </tr>
                            </thead>
                            <tbody data-link="row" class="rowlink">
                            </tbody>
                        </table>
                    </div>
                    <!-- /table -->
                </div>
                <!-- /single line -->
                <!-- Invoice archive -->
                <div class="col-lg-12 display-pedidos" id="panel_autoizacion_salida" style="display: none;">
                    <div class="card border-left-3 border-left-danger rounded-left-0">
                        <div class="card-header bg-white header-elements-sm-inline">
                            <h6 class="card-title"></h6>
                            <div class="header-elements">Folio:
                                <span class="badge badge-danger ml-3" onclick="envia()" style="cursor: pointer;" id="folio_pase_salida"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-xs dt-responsive" id="dt_for_vobo" width="100%">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Unidad</th>
                                        <th>Articulo</th>
                                        <th>Destino</th>
                                        <th>Justificación</th>
                                        <th>Autorizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="row w-100">
                            <div class="col-sm-3 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-pink text-center" readonly id="firma_almacenista" data-idempleado="">
                                    <div class="d-block form-text text-center">
                                        <span class="badge">Encargado Almacen</span>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" disabled>
                                            <i class="icon-pencil3 text-blue-800"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-pink text-center" readonly data-idempleado="" data-tokenid="salida_almacen_vobo_1" id="firma_vobo">
                                    <div class="d-block form-text text-center">
                                        <span class="badge">Vo. Bo.</span>
                                    </div>
                                    <div class="form-control-feedback">
                                        <button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm" id="id_firma_vobo" onclick="firma_almacen('firma_vobo')">
                                            <i class="icon-pencil3 text-blue-800"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <div class="form-group-feedback form-group-feedback-right">
                                    </div>
                                <textarea rows="1" cols="3" class="form-control form-control-sm font-weight-semibold text-blue-800" id="vale_observacion" maxlength="200" readonly></textarea>
                                    <div class="d-block form-text text-justify">
                                        <span class="badge">Observación</span>
                                </div>
                            </div>
                            <div class="col-sm-2 form-group text-right">
                                <button type="button" class="btn btn-success btn-sm" data-aprobado="" id="btn_envia_guarda_valesalida" onclick="guarda_cambios()">Enviar</button>
                            </div>
                            </div>
                    </div>
                    </div>
                </div>
                <!-- /invoice archive -->
            </div>
            <!-- /right content -->
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
            <!-- /content area -->            
            <!-- Footer -->
            <?php include "../bar_nav/footer_navbar.php"; ?>
            <!-- /footer -->
        </div>
    </div>
</body>
</html>
