<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_solicitudes();
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha_solicitud']);
        $d = $date->format('d');
        $m = $date->format('M');
        $fecha = "<article class='media event'>
                    <a class='pull-left date'>
                      <p class='day' style='color: black;'>$d</p>
                      <p class='month' style='color: black;'>$m</p>
                    </a>
		  </article>";
        $nombre_e = $valor['nombre']." ".$valor['apellidos'];
        $folio = $valor['folio'];
        $revisar = "<button type='button' class='btn btn-primary btn-xs' onclick='visor_pedido($folio)'><i class='fa fa-folder-open'></i> Revisar </button>";
        $data[] = array("folio" => pedido($folio),
                        "fecha_solicitud" => $fecha,
                        "clave_solicita" => $revisar,
                        "nombre" => "<a><b>$nombre_e</b></a>"
                        );
    }
    
    function pedido($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos($folio);
        $p = "";
        $x = "<table class='table table-hover compact'>
                <tbody  style='padding:5px; vertical-align:middle;'>";
        foreach ($pedidos as $valor) {
            $cantidad = $valor['cantidad'];
            $unidad = $valor['unidad'];
            $articulo = $valor['articulo'];
            $destino = $valor['destino'];
            $autorizado = t_icon($valor['autorizado']);
            $status = t_icon($valor['status_pedido']);
            $coment = comentario($valor['comentario']);
            $p = "<tr>
                    <td style='width:10%'><span class='label label-primary'>$cantidad $unidad</span></td>
                    <td style='width:50%'><small><b>$articulo<b></small></td>
                    <td style='width:20%'><small>$destino</small></td>
                    <td style='width:20%'>$status $coment</td>
                  </tr>".$p;
        }
    $y = "</tbody>
        </table>";
    return $x.$p.$y;
    }
    function t_icon($st,$coment=""){
       $status = array(
            "<i class='fa fa-circle-o' title='No revisado'></i>",
            "<i class='fa fa-check-circle' title='Aprobado' style='color: green'></i>",
            "<i class='fa fa-times-circle' title='Solicitud cancelada' style='color: red'></i>",
            "<i class='fa fa-flag' title='En revisión' style='color: orange'></i>",
            "<i class='fa fa-shopping-cart' title='Enviado a compra' style='color: #F39C12'></i>",
            "<i class='fa fa-star' title='Listo para entrega' style='color: blue'></i>",
            "<i class='fa fa-check' title='Entregado'></i>",
            "<i class='fa fa-comment' title='$coment' style='color: #1AB6F0'></i>",
            ""
        );
        return $status[$st];
    }
    function comentario($coment){
        if(!empty($coment)){
            return t_icon(7,$coment);
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    