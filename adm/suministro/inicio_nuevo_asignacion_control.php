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
   <link href="css/css_custom.css" rel="stylesheet" type="text/css">
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
                    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                        <div class="d-flex">
                            <div class="breadcrumb-elements-item dropdown p-0 text-slate-600">
                                <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-more2 mr-2"></i>
                                    Menú
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" onclick="openCardNewAsignacion()"><i class="icon-user-lock"></i> Nueva asignación</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                                <div class="breadcrumb">
                                <a href="#" class="breadcrumb-item font-weight-semibold"><i class="icon-home2 mr-2"></i> Control de asignación de herramientas y metarial de trabajo</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content area -->
                    <div class="content">
                        <div class="card border-y-3 border-top-success border-bottom-success rounded-0" id="card_addAsignacion">
                        <div class="card-header bg-white header-elements-inline">
                             <a href="#" class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3 legitRipple" id="nombre_style" data-toggle="modal" data-target="#busca_empleado">
                                <i class="icon-user-plus mr-0"></i>
                            </a>
                            <div class="header-elements">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-3">
                                        <input type="date" class="form-control font-weight-semibold text-indigo-700 mr-3" id="fecha_actual" required>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-danger" onclick="cerrarNewAsignacion()"><i class="icon-cross2 mr-2"></i> Salir</a>
                                    </li>
                                </ul>   
                            </div>
                        </div>
                        <div class="card-body" id="mod_pedido">
                            <div class="row d-none">
                                <div class="col-md-12">
                                    <fieldset>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" class="form-control font-weight-semibold text-indigo-700 new-solicitud-form" id="solicitante" data-idempleado="" placeholder="Nombre del solicitante" readonly onkeyup="mayus(this);" required>
                                                <div class="form-control-feedback form-control-feedback-lg">
                                                    <i class="icon-plus-circle2 text-pink-800"  style="cursor: pointer"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>                          
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-xs table-responsive table-border-dashed tabla-reslta-row-hover" style="width:100%" id="articulo_tabla_aplica">
                                        <col width="5%">
                                        <col width="95%">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-xs table-responsive table-border-dashed datatable-basic text-nowrap tabla-reslta-row-hover" style="width:100%" id="tabla_pedidos">
                                        <col width="5%">
                                        <col width="95%">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <div class="list-icons">
                                <button type="button" class="btn btn-sm btn-primary" id="btn_send_pedido" onclick="recorreDataTable()" title="Enviar solicitud">Guardar <i class="icon-floppy-disk ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Search field -->
                        <!-- /search field -->
                        <div class="card-group">
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <table class="table table-xs table-responsive table-border-dashed datatable-basic text-nowrap tabla-reslta-row-hover" id="personal_tabla" style="width:100%">
                                        <col width="5%">
                                        <col width="50%">
                                        <col width="45%">
                                        <thead>
                                            <tr>
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
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <h4 class="font-weight-semibold mb-1 text-center" id="nombre_empleado" data-idempleado=""></h4><input type="hidden" value="0" id="filtro_asignaciones">
                                    <table class="table table-xs table-responsive table-border-dashed datatable-basic text-nowrap tabla-reslta-row-hover" id="solicitudes_tabla" style="width:100%">
                                        <col width="75%">
                                        <col width="10%">
                                        <col width="10%">
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
                    <!-- /dashboard content -->
                    </div>
                    <!-- Modal with invoice -->
                    <div id="busca_empleado" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-xs table-border-dashed datatable-basic text-nowrap tabla-reslta-row-hover" style="width:100%" id="empleado_tabla_aplica">
                                                <col width="55%">
                                                <col width="35%">
                                                <col width="10%">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
                    <!-- Modal with invoice -->
                    <div id="busca_articulo" class="modal fade" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-footer bg-transparent">
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewArt()">salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal with invoice -->
                    <!-- Modal new invoice -->
                    <div id="modal_devolucion" class="modal fade" data-idasignacion="">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-pencil5 mr-2"></i> DEVOLUCIÓN DE MATERIAL DE TRABAJO</legend>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Asignado a:</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_responsable" data-idempleado="">Gerardo Hernández Hernández</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Cargo</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_cargo">Tecnología de la Información</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Fecha de Asignación</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_fecha_recibe">12 de Enero 2021</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Material/Equipo:</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_equipo" >Gerardo Hernández Hernández</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">No. Inventario:</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo"><mark id="a_no_inventario"></mark></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">S/N:</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_no_serie">DER546HTY7I900</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Cod. Articulo:</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_cod_articulo">MAT00034</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Descripción / Especificación Detallada</label>
                                                            <div class="form-control-plaintext font-weight-semibold text-indigo" id="a_descripcion">Material altamente corrosivo con 34. H2S alta concentración</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Fecha de devolución</label>
                                                            <input type="date" class="form-control font-weight-semibold text-indigo" id="a_fecha" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <label class="font-weight-semibold">Comentario u Observaciones</label>
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-indigo" id="a_comentario" placeholder="Comentarios adicionales">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-right text-right">
                                                            <label class="font-weight-semibold">&nbsp;</label><br>
                                                            <button type="button" class="btn btn-sm btn-light btn-loading legitRipple text-pink" onclick="delvolver_material()"><i class="icon-checkmark3 mr-2"></i> Devolver</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-transparent">
                                    <button type="button" class="btn bg-blue-800 btn-sm " id="new_agregarusar" onclick="closeModalDevolver()">Salir</button>
                                    
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
