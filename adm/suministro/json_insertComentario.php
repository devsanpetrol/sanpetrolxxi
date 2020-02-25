<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $comentario = $_POST['comentario'];
    $id_pedido  = $_POST['id_pedido'];
    $id_empleado= $_POST['id_empleado'];
    
    $pedido  = $suministro->set_comentario($comentario,$id_pedido,$id_empleado);
    
    if ($pedido){
        $data = array("result" => "ok");
    }else{
        $data = array("result" => "error");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);