<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_sub_area = $_POST["id_equipo"];
    $categorias = $suministro->get_sub_destinoSuministro($id_sub_area);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_sub_area"=>$valor['id_sub_area'], "nombre_sub_area"=>$valor['nombre_sub_area'], "id_equipo_area"=>$valor['id_equipo_area']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);