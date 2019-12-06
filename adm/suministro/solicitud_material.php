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
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!--custom sp-->
    <link href="../../src/scss/css_menu.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <script src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../build/css/select2.min.css" rel="stylesheet">
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
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Solicitud de Materiales, Bienes y/o Equipo</small></h2>
                    <ul class="quick-list">
                    <li><i class="fa fa-info-circle"></i><a href="#" data-toggle="modal" data-target="#mod_num_formato">SP-MX-CA-FO-003</a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                        <form id="sol_mat" class="form-horizontal form-label-left input_mask" data-numformat="SP-MX-CA-FO-003" data-idformat="1">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="flex" id="flex">
                              <ul class="list-inline" style="margin-top: 0px; margin-bottom: 0px;">
                                  
                              </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" style="width:100%;font-weight:bold;display:none;" class="btn btn-default btn-md red" data-folioz="0" id="folioxx"></button>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="fecha_actual" readonly>
                        </div>
                        <div class="col-sm-1 input-group">
                            <span class="input-group-btn">
                                <button type="button" style="width: 100%; color: red;" class="btn btn-default btn-md" id="remover" title="Remover seleccionado"><i class="fa fa-trash"></i></button>
                            </span>
                            <span class="input-group-btn">
                                <button id="btn_agregapedido" type="button" style="width: 100%" class="btn btn-primary btn-md" data-toggle="modal" data-target="#mod_pedido" title="Agregar"><i class="fa fa-plus"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                       <table id="tabla_pedidos" class="table table-striped compact nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                       <thead class="nowrap">
                         <tr>
                           <th></th>
                           <th>Clave</th>
                           <th>Articulo</th>
                           <th>Unidad</th>
                           <th>Cant.</th>
                           <th>Descripció detallada del articulo</th>
                           <th>Anexo/Condición</th>
                           <th>Justificación</th>
                           <th>Area ó Equipo destinado</th>
                           <th>Aprueba</th>
                           <th>Aprueba</th>
                           <th>Grado Requerimiento</th>
                           <th>Fecha Requerimiento</th>
                           <th>ID Categoría</th>
                         </tr>
                       </thead>
                       <tbody></tbody>
                     </table>
                    </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-10 form-group"></div>
                        <div class="col-md-1 form-group">
                            <button type="button" class="btn btn-primary">Cancelar</button>
                        </div>
                        <div class="col-md-1 form-group">
                            <button type="button" class="btn btn-success" onclick="get_folio()" id="btn_guardapedido">Enviar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
          <br />
        </div>
        <!-- /page content -->
        <div class="modal fade bs-example-modal-lg" id="mod_num_formato" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="num_formato">Modal title</h4>
              </div>
              <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12 form-group">
                      <label>Función</label>
                      <input type="text" class="form-control" id="funcion" readonly>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Región</label>
                      <input type="text" class="form-control" id="region" readonly>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Revisado por</label>
                      <input type="text" class="form-control" id="revisado" readonly>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Autorizado por</label>
                      <input type="text" class="form-control" id="autorizado" readonly>
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="heard">Fecha de Rev.</label>
                      <input type="text" class="form-control" id="fecha_rev" readonly>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" id="mod_pedido" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
              </div>
              <div class="modal-body">
                  <form id="add_articulo">
                  <div class="row">
                    <div class="col-sm-12 form-group xdisplay_inputx">
                        <label>Busqueda de articulo</label>
                        <div class="input-group">
                            <select class='mi-selector' name='articulo_cod' id="select_article" style='width: 100%'>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-sm" onclick="reset_select2()"><i style="color: red;" class="fa fa-refresh"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12 form-group xdisplay_inputx"></div>
                    <div class="col-sm-6 form-group">
                        <label>Grado de Requerimiento de la compra</label>
                      <p>
                        Inmediata: <input type="radio" class="flat" name="grado_r" value="inmediato" checked required /> 
                        Programada:<input type="radio" class="flat" name="grado_r" value="programado" />
                      </p>
                    </div>
                    <div class="col-sm-6 form-group">
                      <div class="controls">
                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                          <label>Fecha estimada de requerimiento</label>
                          <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3" style="width:100%;" disabled>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2 form-group">
                      <label>Codigo</label>
                      <input type="text" class="form-control" id="cod_articulo" readonly>
                    </div>
                    <div class="col-sm-6 form-group">
                      <label>Articulo</label><label style="color: red;"> *</label>
                      <input type="text" class="form-control" id="descripcion" required="true" onkeyup="mayus(this);">
                    </div>
                    <div class="col-sm-2 form-group">
                      <label>Unid.</label>
                      <select name="select" class="select2_group form-control" id="unidad">
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
                    <div class="col-sm-2 form-group">
                      <label>Cant.</label>
                      <input type="number" class="form-control" step="1" value="1" min="0" id="cantidad" required="true">
                    </div>
                    <div class="col-sm-9 form-group">
                      <label>Descripción detallada</label>
                      <input type="text" class="form-control" id="especificacion" onkeyup="mayus(this);">
                    </div>
                    <div class="col-sm-3 form-group">
                      <label>Categoria</label>
                      <select name="select" class="select2_group form-control" id="select_categoria" required>
                      </select>
                    </div>
                    <div class="col-sm-6 form-group">
                      <label>Anexo/Condición</label>
                      <input type="text" class="form-control" id="anexo" onkeyup="mayus(this);">
                    </div>
                    <div class="col-sm-6 form-group">
                      <label>Area/Equipo destinado</label><label style="color: red;"> *</label>
                      <input type="text" class="form-control" id="area_aquipo" required="true" onkeyup="mayus(this);">
                    </div>
                    <div class="col-sm-12 form-group">
                      <label>Justificación de compra</label><label style="color: red;"> *</label>
                      <input type="text" class="form-control" id="justificacion" required="true" onkeyup="mayus(this);">
                    </div>
                  </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" onclick="getValRadio()">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="agregar_pedido()">Agregar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- footer content -->
        <?php include '../../sidebar/footer_content.php'; ?>
        <!-- /footer content -->
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
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
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
    <script src="js/engineJS.js"></script>
  </body>
</html>