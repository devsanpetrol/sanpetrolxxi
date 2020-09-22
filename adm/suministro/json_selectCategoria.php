<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $tipo = $_POST['tipo'];
    $categorias = $suministro->get_categoria_articulo($tipo);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_categoria"=>$valor['id_categoria'], "categoria"=>$valor['categoria']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   