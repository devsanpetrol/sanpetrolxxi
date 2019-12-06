<?php include_once '../ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> SANPETROL </title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!--custom sp-->
    <link href="../../src/scss/css_menu.css" rel="stylesheet">
        <!-- iCheck -->
   <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="css/css_custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="../index.php" class="site_title" style="height: 90px;">
                <div class="profile profile_pic"><img src="../../page/img/logo.jpg" alt="..." class="img-circle profile_img"></div><span>SANPETROL</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <?php include '../../sidebar/side_bar_menu.php'; ?>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <?php include '../../sidebar/top_navigation.php'; ?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!-- /top tiles -->
          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Solicitudes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p></p>
                    <!-- start project list -->
                    <table class="table table-striped projects" id="dt_solicitudes">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Empleado</th>
                          <th>Solicitud</th>
                          <th style="width: 5%"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <!-- end project list -->
                  </div>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" id="visor_solicitud" data-backdrop="static" data-keyboard="true" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" id="modal_detalle_pedido">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <!--- MAIL LIST -->
                                <div class="col-sm-4 mail_list_column" id="list_pedidos_x">
                                </div>
                                <!-- /MAIL LIST -->
                                <!-- CONTENT MAIL -->
                                <div class="col-sm-8 mail_view">
                                  <div class="inbox-body">
                                    <div class="mail_heading row">
                                      <div class="col-md-8">
                                          <small>Solicita</small></br>
                                        <strong  id="nombre"></strong>
                                          <span id="especialista"></span></br>
                                        <small id="fecha_solicitud"></small>
                                      </div>
                                      <div class="col-md-4 text-right">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="En revisión"><i class="fa fa-flag" style="color: orange"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Aprobar esta partida"><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Envía a compra"><i class="fa fa-shopping-cart"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Listo para entrega"><i class="fa fa-star"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Entregado"><i class="fa fa-check"></i></button>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                          <h4 id="articulo"></h4>
                                      </div>
                                    </div>
                                    <div class="sender-info">
                                      <div class="row">
                                      </div>
                                    </div>
                                      <div class="view-mail" id="id_pedido" data-id_pedido_x="">
                                      </br>
                                      <div class="row">
                                          <div class="col-md-4">
                                              <strong>Grado de Requerimiento</strong>
                                              <p class="boldblue" id="grado_requerimiento"></p>
                                          </div>
                                          <div class="col-md-4">
                                              <strong>Fecha Max.</strong>
                                              <p class="boldblue" id="fecha_requerimiento"></p>
                                          </div>
                                          <div class="col-md-4">
                                              <strong>Codigo del Articulo</strong>
                                              <p class="boldblue" id="cod_articulo"></p>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                              <strong>Cantidad solicitada</strong>
                                              <p class="boldred" id="cantidad"></p>
                                          </div>
                                          <div class="col-md-4">
                                              <strong>Categoria</strong>
                                              <p class="boldblue" id="categoria"></p>
                                          </div>
                                          <div class="col-md-4">
                                              <strong>Area o equipo destinado</strong>
                                              <p class="boldred" id="destino"></p>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <strong>Descripción detallada</strong>
                                              <p class="boldblue" id="detalle_articulo"></p>
                                          </div>
                                          <div class="col-md-6">
                                              <strong>Anexo/Condición</strong>
                                              <p class="boldblue" id="anexo_codicion"></p>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <strong>Justificacion para la adquisición</strong>
                                              <p class="boldblue" id="justificacion"></p>
                                          </div>
                                      </div>
                                      <div class="row" id="comentario">
                                      </div>
                                      <div class="row" id="txt_cometario">
                                          <div class="row">
                                            <div class="col-sm-12 form-group">
                                              <label>Agregar comentario</label>
                                            </div>
                                          </div>
                                          <div class="row">  
                                            <div class="col-sm-12 form-group">
                                                <textarea rows="4" cols="10" class="form-control" style="width:100%;resize: none;" id="comentario_txt"></textarea>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12 text-right">
                                              <div class="btn-group">
                                                  <button class="btn btn-sm btn-default" type="button" onclick="coment()" data-placement="top" data-toggle="tooltip" data-original-title="Cancelar/Regresar"><i class="fa fa-mail-reply"></i></button>
                                                  <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Guardar" onclick="guarda_coment()"><i class="fa fa-save"></i> Guardar</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="btn-group">
                                      <button class="btn btn-sm btn-danger" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Cancelar la partida"><i class="fa fa-close"></i> Cancelar</button>
                                      <button class="btn btn-sm btn-default" type="button" onclick="coment()" data-placement="top" data-toggle="tooltip" data-original-title="Agregar comentario"><i class="fa fa-comment"></i> Comentar</button>
                                      <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Revisar inventario"><i class="fa fa-database"></i> Inventario</button>
                                    </div>
                                  </div>
                                <!-- /CONTENT MAIL -->
                            </div>   
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/select2.min.js"></script>
    <!-- Datatables -->
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="js/engineJS_1.js"></script>
  </body>
</html>