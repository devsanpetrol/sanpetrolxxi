<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_departamento();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_departamento"=>$valor['id_departamento'], "departamento"=>$valor['departamento']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   