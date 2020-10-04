<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
        $cantidad = $_POST['cantidad'];
        
        $guarda_cantidad = $suministro->set_update_cantidad_plan($id_pedido, $cantidad);
        
        if ($guarda_cantidad == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=> $guarda_cantidad);
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
