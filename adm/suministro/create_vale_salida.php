<?php
require_once './suministro.php';
$suministro = new suministro();

$folio_valesalida = 157;//$_POST["folio"];

$detalle_pedido = $suministro -> get_create_vale_salida($folio_valesalida);

//DATOS DEL NUEVO VALE DE SALIDA

$folio  = $detalle_pedido[0]["folio"];
$recibe = $detalle_pedido[0]["recibe"];
$fecha  = $detalle_pedido[0]["fecha"];

$new_valeSalida = $suministro -> set_new_valesalida_rapido($folio,$recibe,$fecha);

foreach ($detalle_pedido as $valor){
    $data[] = array("cantidad_surtida" => $valor["cantidad_surtida"],
                    "fecha" => $valor["fecha"],
                    "recibe" => $valor["recibe"],
                    "id_pedido" => $valor["id_pedido"],
                    "cod_articulo" => $valor["cod_articulo"]
                );
}

function update_temAlmacen($folio_vale,$id_pedido,$codarticulo,$cant_surtir){
    $suministro2 = new suministro();
    $insert = $suministro2 -> set_valesalidaDetail($folio_vale,$id_pedido,$codarticulo,$cant_surtir);
    $catego = $suministro2 -> exe_factura_detalle($codarticulo);
    $factor = 0;
    
    foreach ($catego as $valor) {
        $factor  += $valor['restante'];
        $restante = $factor - $cant_surtir;
        if($factor >= $cant_surtir){
            $catego2 = $suministro2->set_update_almacenArticleSub($valor['id_factura_detalle'], $restante);
            break;
        }else{
            $catego2 = $suministro2->set_update_almacenArticleSub($valor['id_factura_detalle'], 0);
        }
    }
}

    
//header('Content-Type: application/json');
//echo json_encode($detalle_pedido);

