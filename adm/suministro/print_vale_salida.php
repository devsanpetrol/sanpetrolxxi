<?php 
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $folio_vale = $_POST['folio_vale'];
    $detalle_folio = $suministro->get_solicitud_aprobacion_detalle($folio_vale);
    $detalle_folio_lista = $suministro->detalle_folio_salida_imprimir($folio_vale);
    $dato = $suministro->get_now();
        
        $encargado_almacen = $detalle_folio[0]['encargado_almacen'];
        $fecha_firma_encargado = $detalle_folio[0]['fecha_firma_encargado'];
        $visto_bueno = $detalle_folio[0]['visto_bueno'];
        $fecha_firma_vobo = $detalle_folio[0]['fecha_firma_vobo'];
        
        $nombre_encargado = $detalle_folio[0]['nombre_encargado'];
        $apellido_encargado = $detalle_folio[0]['apellido_encargado'];
        $cargo_encargado = $detalle_folio[0]['cargo_encargado'];
        $nombre_vobo = $detalle_folio[0]['nombre_vobo'];
        $apellido_vobo = $detalle_folio[0]['apellido_vobo'];
        $cargo_vobo = $detalle_folio[0]['cargo_vobo'];
        
        $status_vale = $detalle_folio[0]['status_vale'];
        $observacion = $detalle_folio[0]['observacion'];
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
            <td class="style17"></td>
            <td class="style17"></td>
            <td class="style42 s x">Folio:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $folio_vale; ?></td>
            <td class="style42 s x">Fecha:</td>
            <td class="style26 style28 x" colspan="2"><?php echo $fecha_actual; ?></td>
          </tr>
          <tr class="row3">
              <td class="style41" colspan="13"></td>
          </tr>
          <tr class="row4">
            <td class="style15 x">Cant.</td>
            <td class="style15 x">Unidad</td>
            <td class="style15 x" colspan="6">Descripción del bien y/o equipo </td>
            <td class="style15 x" colspan="2">Destino</td>
            <td class="style15 x" colspan="3">Autorizó</td>
          </tr>
          <!--INICIA CICLO DE ELEMENTOS SURTIDOS-->
          <?php
            foreach ($detalle_folio_lista as &$valor) {
                echo "<tr class='row4'>
                        <td class='style2 x' style='vertical-align:middle;'>".$valor["cantidad_aprobada"]."</td>
                        <td class='style2 x' style='vertical-align:middle;'>".$valor["unidad"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='6'>".$valor["articulo"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='2'>".$valor["destino"]."</td>
                        <td class='style2' style='vertical-align:middle;padding: 5px;' colspan='3'>".$valor["autoriza"]."</td>
                      </tr>";
            }
          ?>  
          <!--FINALIZA CICLO DE ELEMENTOS SURTIDOS-->
          <tr class="row16">
            <td class="style11 s style12 x" colspan="2">Observacion:</td>
            <td class="style13" style="text-align:left;font-style: italic;padding: 5px;" colspan="11"><?php echo $observacion; ?></td>
          </tr>
          <tr class="row16">
            <td class="style30"></td>
            <td class="style29" colspan="3"><?php echo $nombre_encargado." ".$apellido_encargado; ?></td>
            <td class="style30"></td>
            <td class="style29" colspan="3"><?php echo $nombre_vobo." ".$apellido_vobo; ?></td>
            <td class="style30"></td>
            <td class="style29" colspan="3"></td>
            <td class="style30"></td>
          </tr>
          <tr class="row0">
            <td class="style21"></td>
            <td class="style20" colspan="3">Nombre y firma Encargado de almacen</td>
            <td class="style21"></td>
            <td class="style20" colspan="3">Nombre y firma Vo. Bo.</td>
            <td class="style21"></td>
            <td class="style20" colspan="3">Nombre y firma Recibe</td>
            <td class="style21"></td>
          </tr>
        </tbody>
    </table>
  </body>
</html>
