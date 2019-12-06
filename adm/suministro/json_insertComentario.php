<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $id_pedido  = $_POST['id_pedido'];
    $comentario = $_POST['comentario'];
    
    $pedido  = $suministro->set_comentario($id_pedido,$comentario);
    
    foreach ($pedido as $valor){
        $data[] = array("comentario" => $valor["comentario"]);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);