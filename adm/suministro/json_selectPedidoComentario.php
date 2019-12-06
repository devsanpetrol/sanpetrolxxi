<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $categorias = $suministro->get_pedido_comentario($id_pedido);
    $data = array();
    
    foreach ($categorias as $valor){
        $data[] = array("supervisor" => ucwords(mb_strtolower($valor["nombre"])));
    }
    header('Content-Type: application/json');
    echo json_encode($data);
   