<?php 
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $folio_vale = $_POST['folio_vale'];
    $detalle_folio = $suministro->get_select_query_("SELECT * FROM adm_view_valesalida_solicitud WHERE folio_vale_salida = $folio_vale");
    $detalle_vobo = $suministro->get_select_query_("SELECT * FROM adm_view_responsable_depto WHERE id_empleado = ".$detalle_folio[0]['firm_planeacion']);
    $detalle_coor = $suministro->get_select_query_("SELECT * FROM adm_view_responsable_depto WHERE id_empleado = ".$detalle_folio[0]['firm_coordinacion']);
    
    $dfl = $suministro->get_select_query_("SELECT * FROM adm_view_valesalida_detail WHERE folio_vale_salida = $folio_vale");
    $dato = $suministro->get_now();
        
        if(!empty($detalle_vobo)){
            $visto_bueno = $detalle_vobo[0]['nombre']." ".$detalle_vobo[0]['apellidos'];
            $visto_bueno_cargo = $detalle_vobo[0]['cargo'];
        }else{
            $visto_bueno = "";
            $visto_bueno_cargo = "";
        }
        if(!empty($detalle_vobo)){
            $coordinador = $detalle_coor[0]['nombre']." ".$detalle_coor[0]['apellidos'];
            $coordinador_cargo = $detalle_coor[0]['cargo'];
        }else{
            $coordinador = "";
            $coordinador_cargo = "";
        }
        
        $nombre_recibe = $detalle_folio[0]['recibe'];
        $nombre_generico = $detalle_folio[0]['nombre_generico'];
        $nombre_solicito = $detalle_folio[0]['nombre_solicitante'];
        $nombre_puesto = $detalle_folio[0]['puesto_solicitante'];
        $sitio = $detalle_folio[0]['sitio_operacion'];
        $fecha_actual = $dato[0]['fecha_actual'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="company" content="Microsoft Corporation" />
      <link href="css/print_pase_salida.css" rel="stylesheet" type="text/css">
      <script>
        window.onload=function() {
            window.resizeTo(screen.availWidth, screen.availHeight);
            window.moveTo(0,0); 
            window.print();
        };
      </script>
  </head>
  <body>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <col class="col0">
        <tbody>
          <tr class="row0">
              <td class="style31 style38" colspan="3" rowspan="3"><img src="../../global_assets/images/placeholders/Imagen3.png" class="img-fluid rounded-circle mb-3" width="80" height="80" alt=""></td>
            <td class="style7 s x" colspan="10">VALE DE SALIDA (MATERIAL Y EQUIPOS)</td>
          </tr>
          <tr class="row0">
            <td class="style6 s x" colspan="2">
                <span class="span-style">Función:</span><br />
                <span class="span-style2">Compras y Almacén</span>
            </td>
            <td class="style6 s x" colspan="3">
                <span class="span-style">Región:</span><br />
                <span class="span-style2">México</span>
            </td>
            <td class="style6 s x" colspan="5">
                <span class="span-style">Número de Formato:</span><br />
                <span class="span-style2">SP-MX-CA-FO-03</span>
            </td>
          </tr>
          <tr class="row0">
            <td class="style6 s x" colspan="2">
                <span class="span-style">Revisado por:</span><br />
                <span class="span-style2">Coordinador Administrativo</span>
            </td>
            <td class="style6 s x" colspan="3">
                <span class="span-style">Autiorizado por:</span><br />
                <span class="span-style2">Gerencia General</span>
            </td>
            <td class="style6 s x" colspan="2">
                <span class="span-style">Fecha Rev.:</span><br />
                <span class="span-style2">03 / Jun / 19</span>
            </td>
            <td class="style6 s x" colspan="2">
                <span class="span-style">Rev. No.:</span><br />
                <span class="span-style2">1.0</span>
            </td>
            <td class="style6 s x">
                <span class="span-style">Página:</span><br />
                <span class="span-style2">1 de 1</span>
            </td>
          </tr>
          <tr class="row3">
              <td class="style39" colspan="13"></td>
          </tr>
          <tr class="row4">
            <td class="style40"></td>
            <td class="style40"></td>
            <td class="style17"></td>
            <td class="style17"></td>
            <td class="style17"></td>
            <td class="style42 s x">Area/Equipo:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $nombre_generico.", ".$sitio; ?></td>
            <td class="style42 s x">Folio:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $folio_vale; ?></td>
            <td class="style42 s x">Fecha:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $fecha_actual; ?></td>
          </tr>
          <tr class="row4">
            <td class="style40"></td>
            <td class="style40"></td>
            <td class="style17"></td>
            <td class="style17"></td>
            <td class="style17"></td>
            <td class="style42 s x">Solicitó:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $nombre_solicito ." (".$nombre_puesto.")"; ?></td>
            <td ></td>
            <td  colspan="2"></td>
            <td ></td>
            <td  colspan="2"></td>
          </tr>
          <tr class="row3">
              <td class="style41" colspan="13"></td>
          </tr>
          <tr class="row4">
            <td class="style15 x">Cant.</td>
            <td class="style15 x">Unidad</td>
            <td class="style15 x" colspan="6">Descripción del bien y/o equipo </td>
            <td class="style15 x" colspan="2">Destino</td>
            <td class="style15 x" colspan="3">Justificación</td>
          </tr>
          <!--INICIA CICLO DE ELEMENTOS SURTIDOS-->
          <?php
            foreach ($dfl as &$valor) {
                echo "<tr class='row4'>
                        <td class='style2 x' style='vertical-align:middle;'>".$valor["cantidad_surtida"]."</td>
                        <td class='style2 x' style='vertical-align:middle;'>".$valor["unidad"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='6'>".$valor["articulo"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='2'>".$valor["nombre_sub_area"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='3'>".$valor["justificacion"]."</td>
                      </tr>";
            }
          ?>  
          <!--FINALIZA CICLO DE ELEMENTOS SURTIDOS-->
          <tr class="row16">
            <td class="style11 s style12 x" colspan="2">Observacion:</td>
            <td class="style13" style="text-align:left;font-style: italic;padding: 5px;" colspan="11"><?php echo $observacion = ""; ?></td>
          </tr>
          <tr class="row16">
            <td class="style30"></td>
            <td class="style29" colspan="3"><?php echo $coordinador; ?></td>
            <td class="style30"></td>
            <td class="style29" colspan="3"><?php echo $visto_bueno; ?></td>
            <td class="style30"></td>
            <td class="style29" colspan="3"><?php echo $nombre_recibe ?></td>
            <td class="style30"></td>
          </tr>
          <tr class="row0">
            <td class="style21"></td>
            <td class="style20" colspan="3">Coordinación</td>
            <td class="style21"></td>
            <td class="style20" colspan="3">Vo. Bo.</td>
            <td class="style21"></td>
            <td class="style20" colspan="3">Nombre y firma Recibe</td>
            <td class="style21"></td>
          </tr>
        </tbody>
    </table>
  </body>
</html>
