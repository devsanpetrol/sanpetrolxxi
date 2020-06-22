<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $folio_vale = $_POST['folio_vale'];
    $id_pedido  = $_POST['idpedido'];
    $codarticulo= $_POST['codarticulo'];
    $cant_surtir= $_POST['cant_surtir'];
    
    $insert  = $suministro -> set_valesalidaDetail($folio_vale,$id_pedido,$codarticulo,$cant_surtir);
    $status  = $suministro -> update_status_pedido($id_pedido);
    
    if ($insert){
        $data = array("result" => "ok");
    }else{
        $data = array("result" => "error");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);