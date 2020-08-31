<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $folio_vale = $_POST['folio_vale'];
    $id_pedido  = $_POST['idpedido'];
    $codarticulo= $_POST['codarticulo'];
    $cant_surtir= $_POST['cant_surtir'];
    
    $insert = $suministro -> set_valesalidaDetail($folio_vale,$id_pedido,$codarticulo,$cant_surtir);
    $catego = $suministro -> exe_factura_detalle($codarticulo);
    $factor = 0;
    
    foreach ($catego as $valor) {
        $factor  += $valor['restante'];
        $restante = $factor - $cant_surtir;
        if($factor >= $cant_surtir){
            $catego2 = $suministro->set_update_almacenArticleSub($valor['id_factura_detalle'], $restante);
            break;
        }else{
            $catego2 = $suministro->set_update_almacenArticleSub($valor['id_factura_detalle'], 0);
        }
    }
    
    if ($insert){
        $data = array("result" => "ok");
    }else{
        $data = array("result" => "error");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);