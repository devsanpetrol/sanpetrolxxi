<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['id_grupo_activo']) && !empty ($_POST['data'])){
        $datos = json_decode(stripslashes($_POST['data']));
        $id_g = $_POST['id_grupo_activo'];
        
        foreach($datos as $d){
            $r = $suministro->grupos_mover_agrupo($d, $id_g);
            if($r == 0){
                $data[] = array('type' => 'error', 'cod_articulo' => $d);
            }
        }
        if (count($data) == 0){
            $data[] = null;
        }
    }else{
        $data[] = array('result' => '', 'type' => 'vacio');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);