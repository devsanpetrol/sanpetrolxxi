<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    
    $articulos = $suministro->get_status_pedido_man($_POST['id_pedido']);
    $data = array();
    
    foreach ($articulos as $valor) {
        $data[] = array("aprobacion"=>$valor['aprobacion']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   