<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_ambito();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_ambito"=>$valor['idambito'], "ambito"=>$valor['ambito']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   