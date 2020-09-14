<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_puesto();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_puesto"=>$valor['id_nivel_org'], "puesto"=>$valor['puesto']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   