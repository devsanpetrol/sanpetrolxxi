<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $grupos = $suministro->get_categoria_activos();
    $data = array();
    
    foreach ($grupos as $valor) {
        $data[] = array("categoria" => css_main_menu($valor['categoria'],$valor['id_categoria']),
                        "id_categoria" => $valor['id_categoria']
                        );
    }
    function css_main_menu($categoria,$id_categoria){
        return "<a class='dropdown-item subgrupos' data-idcategoria='$id_categoria' data-title='$categoria' onclick='load_main_categoria(event)'><i class='icon-folder2'></i>$categoria</a>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);