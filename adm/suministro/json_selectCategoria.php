<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_categoria_articulo();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_categoria"=>$valor['id_categoria'], "categoria"=>$valor['categoria'], "id_empleado_resp"=>$valor['id_empleado_resp'], "nombre"=>$valor['nombre'], "apellidos"=>$valor['apellidos']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   