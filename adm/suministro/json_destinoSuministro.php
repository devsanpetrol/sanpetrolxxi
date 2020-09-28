<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    if(empty($_POST["filter"])){
        $categorias = $suministro->get_destinoSuministro();
    }else{
        $categorias = $suministro->get_destinoSuministro($_POST["filter"]);
    }
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_equipo"=>$valor['id_equipo'], "nombre_generico"=>$valor['nombre_generico'], "id_coordinacion"=>$valor['id_coordinacion']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);