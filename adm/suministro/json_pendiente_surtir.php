<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido       = $_POST['id_pedido'];
        $set_update_pedido = $suministro->set_update_enviado_pendiente_surtir($id_pedido);
        if ($set_update_pedido == 1){
            $data[] = array('result' => 'exito');
        }else{
            $data[] = array('result' => $set_update_pedido, 'set_update_pedido' => false);
        }
    }else{
            $data[] = array('result' => 'falla_recepcion_dato','id_pedido' => 'is_empty');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);