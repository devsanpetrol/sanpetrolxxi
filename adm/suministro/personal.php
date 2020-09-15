<?php require_once '../../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SANPETROL XXI - Catálogos</title>

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
    <script src="js/engineJS_50.js"></script>
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
                        <?php include "./sidebar_catalogo.php"; ?>
			<!-- /sidebar content -->
		</div>
		<!-- Main content -->
		<div class="content-wrapper">
                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-md-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Personal</span></h4>
                                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content area -->
                    <div class="content">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datatable-basic" id="personal_tabla" style="width:100%">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="30%">
                                        <col width="25%">
                                        <col width="5%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Cargo</th>
                                                <th>Depto.</th>
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
                    <div id="new_employe" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-menu7 mr-2"></i> DATOS PERSONALES</legend><input type="hidden" id="id_persona" data-idpersona="" data-idempleado="">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_nombre" placeholder="Nombre">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-user-tie"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_apellidos" placeholder="Apellidos">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-price-tag2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_email_personal" placeholder="E-Mail Personal">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-envelop3"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_telefono_personal" placeholder="Tel. personal">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-phone-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_direccion" placeholder="Dirección">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-direction"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_cod_postal" placeholder="Codigo Postal"> 
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-mailbox"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_ciudad" placeholder="Ciudad">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-city"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_edo_prov" placeholder="Estado o Provincia">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-map5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <div class="form-check form-check-inline form-check-right">
                                                                <label class="form-check-label">
                                                                    <span class="badge" id="bg-f">Masculino</span>
                                                                    <input type="radio" class="form-check-input" name="radio-unstyled-inline-right" id="new_genero_1">
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline form-check-right">
                                                                <label class="form-check-label">
                                                                    <span class="badge" id="bg-f">Femenino</span>
                                                                    <input type="radio" class="form-check-input" name="radio-unstyled-inline-right" id="new_genero_2">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800  form-update-employ" id="new_curp" placeholder="C.U.R.P.">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-vcard"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="font-weight-semibold text-danger-800"><i class="icon-menu7 mr-2"></i> DATOS DEL EMPLEADO</legend>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select data-placeholder="Ambito" class="form-control form-control-select2 text-right form-control-sm" id="new_ambito" data-fouc>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select data-placeholder="Departamento" class="form-control form-control-select2 text-right form-control-sm" id="new_departamento" data-fouc>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select data-placeholder="Puesto" class="form-control form-control-select2 text-right form-control-sm" id="new_puesto" data-fouc >
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_email" placeholder="E-Mail">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-envelop3"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800  form-update-employ" id="new_cargo" placeholder="Cargo">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-collaboration"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_especialista" placeholder="Especialista">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-design"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="date" class="form-control font-weight-semibold text-blue-800" id="new_fecha_alta">
                                                            <span class="form-text text-muted text-center">Fecha de Ingreso</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="date" class="form-control font-weight-semibold text-blue-800" id="new_fecha_baja">
                                                            <span class="form-text text-muted text-center">Fecha de Baja</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                                            <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 form-update-employ" id="new_telefono_empleo" placeholder="Telefono">
                                                            <div class="form-control-feedback form-control-feedback-sm">
                                                                <i class="icon-phone-plus"></i>
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
                                    <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="close_propiedadPersonal()">CERRAR</button>
                                    <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="updPersonal()">GUARDAR</button>
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
