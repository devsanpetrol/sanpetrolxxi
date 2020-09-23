<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $tipo = $_POST['tipo'];
    $categorias = $suministro->get_categoria_articulo($tipo);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("resume_name"=>$valor['resume_name'], "categoria"=>$valor['categoria']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   