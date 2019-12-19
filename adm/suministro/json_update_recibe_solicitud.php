<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $id_valesalida_pedido = $_POST['id_valesalida_pedido'];
    $recibe = $_POST['recibe'];

    $guarda_recibe = $suministro -> set_update_recibe_solicitud($id_valesalida_pedido, $recibe);
    if($guarda_recibe){
        $data[] = array("result" => 'exito');
    }else{
        $data[] = array("result" => $guarda_recibe);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);