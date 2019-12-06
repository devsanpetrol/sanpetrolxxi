<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
        $status_pedido = $_POST['status_pedido'];
        
        $set_update_pedido  = $suministro->set_update_pedido($id_pedido, $status_pedido);
        if ($set_update_pedido == true){
            $data[] = array("result"=>'exito',"status_pedido"=>$status_pedido);
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);