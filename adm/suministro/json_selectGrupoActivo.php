<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    //$tipo = $_POST['tipo'];
    $categorias = $suministro->get_grupo_activo();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_grupo_activo"=>$valor['id_grupo_activo'],
                        "id_main"=>$valor['id_main'],
                        "main_name"=>$valor['main_name'],
                        "grupo_nombre"=>$valor['grupo_nombre']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   