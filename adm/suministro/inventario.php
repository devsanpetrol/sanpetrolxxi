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
    <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/ui/fab.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/sticky.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/prism.min.js"></script>
    <script src="../../global_assets/js/demo_pages/components_popups.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/buttons/spin.min.js"></script>
    <script src="../../global_assets/js/plugins/buttons/ladda.min.js"></script>
    <script src="js/engineJS_8.js"></script>
    <!--<script src="js/ini_menu_almacen.js"></script>-->
    <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../../global_assets/js/plugins/pickers/anytime.min.js"></script>
    
    <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
    <script src="../../global_assets/js/plugins/notifications/pnotify.min.js"></script>
    <script src="../../global_assets/js/demo_pages/extra_fab.js"></script>
    <!-- Theme JS files -->
    <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../../global_assets/js/plugins/forms/styling/switch.min.js"></script>
    
    <!-- /theme JS files -->
</head>

<body class="sidebar-xs sidebar-secondary-hidden">
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
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb-elements-item dropdown p-0 text-slate-600">
                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder2 mr-2"></i>
                            Inicio
                        </a>
                        <div class="dropdown-menu dropdown-menu-left bg-teal">
                            <a href="#" class="dropdown-item" onclick="abre_grupo()"><i class="icon-folder-plus"></i>Nuevo grupo</a>
                            
                            <!--SUB MENU-->
                        </div>
                    </div>
                    <div class="breadcrumb-elements-item dropdown p-0 text-slate-600">
                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-filter3 mr-2"></i>
                            Filtrar
                        </a>
                        <div class="dropdown-menu dropdown-menu-left bg-teal">
                            <a href="#" class="dropdown-item" onclick="load_main()"><i class="icon-archive"></i>TODO</a>
                            <a href="#" class="dropdown-item" onclick="load_main_baja()"><i class="icon-arrow-down52"></i>BAJAS</a>
                            <a href="#" class="dropdown-item" onclick="load_main_disponible()"><i class="icon-clipboard2"></i>DISPONIBLES</a>
                            <div class="dropdown-divider" id="main_menu"></div>
                            <div class="dropdown-divider" id="categoria_activo"></div>
                            
                        </div>
                    </div>
                    <div class="breadcrumb-elements-item dropdown p-0 text-slate-600">
                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-checkbox-checked2 mr-2"></i>
                            Seleccción
                        </a>
                        <div class="dropdown-menu dropdown-menu-left bg-teal">
                            <a href="#" class="dropdown-item" onclick="menu_mover_activo()"><i class="icon-folder-upload2"></i> Mover a...</a>
                            <a href="#" class="dropdown-item" onclick="menu_traza_activo()"><i class="icon-versions"></i>Registrar Trazabilidad</a>
                            <a href="#" class="dropdown-item" onclick="menu_baja_activo()"><i class="icon-blocked"></i>Registrar Baja</a>
                            <a href="#" class="dropdown-item" onclick="menu_asigna_activo()"><i class="icon-user-check"></i>Asignar Material/Equipo...</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" onclick="selec_selecion_filter()"><i class="icon-filter4"></i>Seleccionar Resultado de Busqueda</a>
                            <a href="#" class="dropdown-item" onclick="selec_deselecion_todo()"><i class="icon-checkbox-unchecked2"></i>Deseleccionar Todo</a>
                        </div>
                    </div>
                </div>
                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <div class="breadcrumb">
                        <a href="#" class="breadcrumb-item font-weight-semibold"><i class="icon-home2 mr-2"></i> Control de Inventario Base Sanpetrol</a>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Content area -->
            <div class="content pl-1 pr-1 pt-1">
                <div class="d-md-flex align-items-md-start">
                    <!-- Left sidebar component -->
                    <div class="sidebar sidebar-light sidebar-component bg-transparent border-0 shadow-0 sidebar-expand-md d-none">
                        <!-- Sidebar content -->
                        <div class="sidebar-content" id="sidebar_content_x">
                            
                        </div>
                        <!-- /sidebar content -->
                    </div>
                    <!-- Right content -->
                    <div class="w-100">
                        <!-- /COL-MD-10 TABLA CONTENIDO -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-xs table-responsive table-border-dashed tabla-reslta-row-hover" id="almacen_tabla" style="width:100%;" summary="Descripción de la tabla y su contenido">
                                            <col>
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="44%">
                                            <col width="10%">
                                            <col width="3%">
                                            <col width="3%">
                                            <col width="3%">
                                            <col width="15%">
                                            <col width="2%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>No. Inventario</th>
                                                    <th>No. Serie</th>
                                                    <th>Articulo</th>
                                                    <th>Marca</th>
                                                    <th class="text-black-50">Act.</th>
                                                    <th class="text-black-50">Dis.</th>
                                                    <th class="text-black-50">Ope.</th>
                                                    <th>Grupo</th>
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
                        <!-- /COL-MD-10 TABLA CONTENIDO -->
                    </div>
                </div>
            </div>
            <!-- /content area -->
            <!-- Modal new invoice -->
            <div id="article_new" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="card-body">
                            <form id="form_activo">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-menu7 mr-2"></i> PROPIEDADES DEL ACTIVO</legend>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="new_codigobarra" placeholder="Codigo de barra">
                                                    <span class="form-text text-muted text-right">Codigo de barra</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-barcode2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_cod_inventario" readonly placeholder="SKU.">
                                                    <span class="form-text text-muted text-right">S.K.U.</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-price-tag2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-bold text-blue-800 text-uppercase" id="new_descripcion" placeholder="Descripción *" onkeyup="mayus(this);">
                                                    <span class="form-text text-muted text-right">Nombre</span>
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
                                                    <span class="form-text text-muted text-right">Categoria</span>
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
                                                    <span class="form-text text-muted text-right">Tipo de unidad</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_especificacion" placeholder="Especificación">
                                                    <span class="form-text text-muted text-right">Caracteristica ó Espesificación</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-design"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="new_marca" placeholder="Marca *">
                                                    <span class="form-text text-muted text-right">Marca</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-stamp"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-bookmark mr-2"></i> DATOS DEL ACTIVO</legend>
                                        <input type="hidden" id="new_idarticulo" value="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="new_noinventario" title="No. de Inventario">
                                                    <span class="form-text text-muted text-right">NO. Inventario</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-books"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="new_noserie" title="No. de Serie">
                                                    <span class="form-text text-muted text-right">NO. Serie</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-list-numbered"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_fecha_adquisicion" title="Fecha de adquisición">
                                                    <span class="form-text text-muted text-right">Fecha de aquisición</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-chevron-up text-blue-600"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_fecha_baja" title="Fecha de baja">
                                                    <span class="form-text text-muted text-right">Fecha de baja</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-chevron-down text-danger-600"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="number" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_tiempo_utilidad" title="Vida util del equipo">
                                                    <span class="form-text text-muted text-right">Años</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-watch2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="number" class="form-control form-control-sm font-weight-semibold text-blue-800" id="new_costo" title="Costo de adquisición del articulo">
                                                    <span class="form-text text-muted text-right">Costo</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-coin-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <div class="list-feed border-warning-400">
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="new_status" title="Status del Activo"> Activo</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="new_disponible" title="Disponibilidad"> Disponible</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="new_operable" title="Operabilidad"> Operable</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="new_salida_rapida"> Salida Rapida</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="cerrarArticle()">CERRAR</button>
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" id="set_activo" onclick="setArticle()">GUARDAR</button>
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" id="upd_activo" onclick="updArticle()">ACTUALIZAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="article_upd" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="card-body">
                            <form id="form_activo_upd">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-menu7 mr-2"></i> PROPIEDADES DEL ACTIVO</legend>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="upd_codigobarra" placeholder="Codigo de barra">
                                                    <span class="form-text text-muted text-right">Codigo de barra</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-barcode2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_cod_inventario" readonly placeholder="SKU.">
                                                    <span class="form-text text-muted text-right">S.K.U.</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-price-tag2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-bold text-blue-800 text-uppercase" id="upd_descripcion" placeholder="Descripción *" onkeyup="mayus(this);">
                                                    <span class="form-text text-muted text-right">Nombre</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm font-weight-bold text-blue-800 text-uppercase" disabled id="upd_categoria">
                                                    <span class="form-text text-muted text-right">Categoria</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm font-weight-bold text-blue-800 text-uppercase" disabled id="upd_tipounidad">
                                                    <span class="form-text text-muted text-right">Tipo Unidad</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_especificacion" placeholder="Especificación">
                                                    <span class="form-text text-muted text-right">Caracteristica ó Especificación</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-design"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="upd_marca" placeholder="Marca *">
                                                    <span class="form-text text-muted text-right">Marca</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-stamp"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-bookmark mr-2"></i> DATOS DEL ACTIVO</legend>
                                        <input type="hidden" id="upd_idarticulo" value="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="upd_noinventario" title="No. de Inventario">
                                                    <span class="form-text text-muted text-right">NO. Inventario</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-books"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase" id="upd_noserie" title="No. de Serie">
                                                    <span class="form-text text-muted text-right">NO. Serie</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-list-numbered"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_fecha_adquisicion" title="Fecha de adquisición">
                                                    <span class="form-text text-muted text-right">Fecha de aquisición</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-chevron-up text-blue-600"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_fecha_baja" title="Fecha de baja">
                                                    <span class="form-text text-muted text-right">Fecha de baja</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-chevron-down text-danger-600"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="number" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_tiempo_utilidad" title="Vida util del equipo">
                                                    <span class="form-text text-muted text-right">Años</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-watch2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="number" class="form-control form-control-sm font-weight-semibold text-blue-800" id="upd_costo" title="Costo de adquisición del articulo">
                                                    <span class="form-text text-muted text-right">Costo</span>
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-coin-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <div class="list-feed border-warning-400">
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="upd_status" title="Status del Activo"> Activo</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="upd_disponible" title="Disponibilidad"> Disponible</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="upd_operable" title="Operabilidad"> Operable</label>
                                                    </div>
                                                    <div class="list-feed-item border-warning-400">
                                                        <label><input type="checkbox" value="" id="upd_salida_rapida"> Salida Rapida</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="cerrarArticle_upd()">CERRAR</button>
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" id="upd_activo" onclick="updArticle()">ACTUALIZAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal with invoice -->
            <div id="modal_trazabilidad" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="table-responsive">
                            <table class="table datatable-basic text-nowrap" id="movimiento_tabla_aplica" style="width:100%">
                                <col width="10%">
                                <col width="10%">
                                <col width="40%">
                                <col width="40%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Fecha</th>
                                        <th>Responsable</th>
                                        <th>Condición</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn btn-sm alpha-success text-success-800 legitRipple" id="btnmouestranewpro" onclick="hide_showNewMovimiento()"><i class="icon-plus3"></i></button>
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewProv()">salir</button>
                        </div>
                        <div class="card-body" id="cardnewtraza" style="display: none">
                            <form action="#" id="formnewtraza">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="font-weight-semibold text-danger-800"><i class="icon-pencil5 mr-2"></i> Registrar trazabilidad o movimientos del equipo</legend>
                                        <input id="mov_codarticulo" value="" type="hidden">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="mov_responsable" title="Nombre del responsable" placeholder="Nombre del responsable">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="date" class="form-control form-control-sm font-weight-semibold text-blue-800" id="mov_fecha_movimiento" title="Fecha de registro" placeholder="Fecha de registro">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="mov_motivo" placeholder="Motivo o justificación">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-question4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="mov_ubicacion" placeholder="Lugar de destino" onkeyup="mayus(this);">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-location4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" class="form-control form-control-sm font-weight-semibold text-blue-800" id="mov_condicion" placeholder="Estado/condición actual del equipo">
                                                    <div class="form-control-feedback form-control-feedback-sm">
                                                        <i class="icon-file-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="button" class="btn btn-sm alpha-danger text-danger-800 legitRipple" onclick="hide_showNewMovimiento()" title="Cerrar"><i class="icon-cross2"></i></button>
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
            <!-- Modal with invoice -->
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
                            <button type="button" class="btn btn-sm alpha-success text-success-800 legitRipple" id="btnmouestranewpro" onclick="hide_showNewProveedor()"><i class="icon-plus3"></i></button>
                            <button type="button" class="btn btn-sm alpha-primary text-primary-800 legitRipple" onclick="hide_showModalNewProv()">salir</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="modal_grupo" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="text" class="form-control form-control-lg" id="nuevo_grupo" placeholder="Nombre del grupo..." maxlength="30">
                                        <div class="form-control-feedback form-control-feedback-lg"><i class="icon-folder2 text-orange-300"></i></div>
                                    </div>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                    <label>Categoría:</label>
                                        <select data-placeholder="Categoría" class="form-control form-control-select2 border-danger text-right" name='grupo_main' id="grupo_main" data-fouc>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn bg-grey-300 btn-sm" onclick="nuevo_cancel()">Cancelar</button>
                            <button type="button" class="btn bg-blue-800 btn-sm " id="new_agregarusar" onclick="nuevo_guarda()">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="modal_asignar_grupo" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <label>Mover a:</label>
                                        <select data-placeholder="Asignar ó Mover a Grupo..." class="form-control form-control-select2 border-danger text-right" name='grupo_activo' id="grupo_activo" data-fouc>
                                            <option></option>
                                        </select>
                                        <label>Cod. Articulo:<code id="cod_articulo_move"></code></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn bg-grey-300 btn-sm" onclick="cerrar_modalMover()">Cancelar</button>
                            <button type="button" class="btn bg-blue-800 btn-sm " id="new_agregarusar" onclick="mover_a_grupo()">Mover</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" id="filtro">
            <!-- Modal new invoice -->
            <div id="modal_modificar_grupo" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="text" class="form-control form-control-lg" id="modifica_grupo" data-idgrupo="" data-idgrupo="" data-idmain="" placeholder="Nombre del grupo..." maxlength="30">
                                        <div class="form-control-feedback form-control-feedback-lg"><i class="icon-folder2 text-orange-300"></i></div>
                                    </div>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                    <label>Categoría:</label>
                                        <select data-placeholder="Categoría" class="form-control form-control-select2 text-right" name='grupo_main_edit' id="grupo_main_edit" data-fouc>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <button type="button" class="btn bg-grey-300 btn-sm" onclick="modal_grupo_edita_cierra()">Cancelar</button>
                            <button type="button" class="btn bg-danger btn-sm" onclick="guardar_elimina_grupo()">Eliminar</button>
                            <button type="button" class="btn bg-blue-800 btn-sm " id="new_agregarusar" onclick="guardar_cambio_grupo()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="modal_asignacion" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="card-header bg-white">
                            <h6 class="card-title">
                                <i class="icon-hammer-wrench mr-2"></i>
                                <b>Asignación de Material</b>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                    <label>Buscar empleado:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <label>Fecha:</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback">
                                        <label>&nbsp;</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                    <select data-placeholder="Empleado..." class="form-control form-control-select2 text-right empleados" name='asigna_empleado' id="asigna_empleado" data-fouc>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="date" class="form-control font-weight-semibold text-blue-800 text-center" id="fecha_asignacion" title="Fecha de registro" placeholder="Fecha de registro">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback text-right">
                                        <button type="button" class="btn bg-blue-800 btn-sm " id="new_agregarusar" onclick="asignar_operacion()">Asignar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-transparent">
                            <input type="hidden" id="cod_articulo_asignar" data-equipo="" value="">
                            <button type="button" class="btn bg-grey-300 btn-sm" onclick="cierra_modal_asigna()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_mover_activo" class="modal fade modalmultiple-select">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Mover elementos a...</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <label class="text-slate">Elija el grupo donde deséa mover los elementos seleccionados:</label>
                                        <select data-placeholder="Asignar ó Mover a Grupo..." class="form-control form-control-sm form-control-select2 border-danger text-right" name='grupo_activo_multiple' id="grupo_activo_multiple" data-fouc>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback form-group-feedback-right text-right">
                                        <label class="font-weight-semibold">&nbsp;</label>
                                        </br>
                                        <button type="button" class="btn bg-blue-800 btn-sm " onclick="select_function_exe(event,'mover')" id="btn_mover_grupo">Mover</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row"><div class="col-md-12"><pre id="console_log_area_mover" style="width: 100%;vertical-align: top;text-align: left;" class="border-warning-300"></pre></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="modal_baja_activo" class="modal fade modalmultiple-select">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Los elementos seleccionados seran dados de baja</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="text-slate">Responsables quien realiza y Autoriza:</label>
                                        <input type="text" class="form-control form-control-sm" id="input_responsable_baja" placeholder="Escriba los nombres aquí...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-slate">Fecha:</label>
                                        <input type="date" class="form-control form-control-sm font-weight-semibold text-indigo-700 text-center mr-3" id="input_fecha_baja" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback form-group-feedback-right text-right">
                                        <label class="font-weight-semibold">&nbsp;</label>
                                        </br>
                                        <button type="button" class="btn bg-danger btn-sm " onclick="select_function_exe(event,'baja')" id="btn_baja_activo">Baja</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="text-slate">Describa el motivo o la justificación:</label>
                                        <textarea rows="1" cols="5" class="form-control form-control-sm" id="comentario_baja" placeholder="Escriba aquí..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row"><div class="col-md-12"><pre id="console_baja_activo" style="width: 100%;vertical-align: top;text-align: left;" class="border-warning-300"></pre></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <div id="modal_traza_activo" class="modal fade modalmultiple-select">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registrar información de trazabilidad de los elementos seleccioneados</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="text-slate">Responsables quien realiza y Autoriza:</label>
                                        <input type="text" class="form-control form-control-sm" id="input_responsable_traza">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-slate">Fecha:</label>
                                        <input type="date" class="form-control form-control-sm font-weight-semibold text-indigo-700 text-center mr-3" id="input_fecha_traza" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback form-group-feedback-right text-right">
                                        <label class="font-weight-semibold">&nbsp;</label>
                                        </br>
                                        <button type="button" class="btn bg-primary btn-sm " onclick="select_function_exe(event,'traza')" id="btn_traza_activo">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="text-slate">Lugar de destino:</label>
                                        <input type="text" class="form-control form-control-sm" id="input_lugar_traza" >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="text-slate">Estado o condición actual de los equipos:</label>
                                        <input type="text" class="form-control form-control-sm" id="input_condicion_traza">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="text-slate">Describa el motivo o la justificación del movimiento:</label>
                                        <input type="text" class="form-control form-control-sm" id="input_motivo_traza" >
                                    </div>
                                </div>
                            </div>
                            <div class="row"><div class="col-md-12"><pre id="console_traza_activo" style="width: 100%;vertical-align: top;text-align: left;" class="border-warning-300"></pre></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal new invoice -->
            <input type="hidden" id="is_save" value="0">
            <div id="modal_asigna_activo" class="modal fade modalmultiple-select">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Asignacion de Material y Herramientas de Trabajo</h5>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-dismiss="modal" title="Cerrar"><i class="icon-cross2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="text-slate">Seleccione el personal responsable:</label>
                                        <select data-placeholder="Empleado..." class="form-control form-control-select2 text-right empleados" name='input_responsable_asigna' id="input_responsable_asigna" data-fouc></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-slate">Fecha:</label>
                                        <input type="date" class="form-control form-control-sm font-weight-semibold text-indigo-700 text-center mr-3" id="input_fecha_asigna" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-feedback form-group-feedback-right text-right">
                                        <label class="font-weight-semibold">&nbsp;</label>
                                        </br>
                                        <button type="button" class="btn bg-primary btn-sm " onclick="select_function_exe(event,'asigna')" id="btn_asigna_activo">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row"><div class="col-md-12"><pre id="console_asigna_activo" style="width: 100%;vertical-align: top;text-align: left;" class="border-warning-300"></pre></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include "../bar_nav/footer_navbar.php"; ?>
            <!-- /footer -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>
</html>
