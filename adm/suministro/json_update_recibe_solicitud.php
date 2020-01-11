<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $id_valesalida_pedido = $_POST['id_valesalida_pedido'];
    $recibe = $_POST['recibe'];
    $cantidad_surtir = $_POST['cantidad_surtir'];
    $cantidad_cancelado = $_POST["cantidad_cancelado"];
    $cod_articulo = $_POST['cod_articulo'];
    $id_pedido = $_POST['id_pedido'];

    $guarda_recibe = $suministro -> set_update_recibe_solicitud($id_valesalida_pedido, $recibe,$cantidad_surtir,$cantidad_cancelado,$cod_articulo,$id_pedido);
    $data[] = array("result" => $guarda_recibe);
    
    header('Content-Type: application/json');
    echo json_encode($data);