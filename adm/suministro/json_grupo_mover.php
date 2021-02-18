<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['id_grupo_activo'])){
        $id_grupo_activo = $_POST['id_grupo_activo'];
        $cod_articulo = $_POST['cod_articulo'];
        
        $id_nuevo_grupo = $suministro->grupos_mover_agrupo($cod_articulo, $id_grupo_activo);
        
        if($id_nuevo_grupo >= 1){
            $data[] = array('result' => $id_nuevo_grupo, 'type' => 'exito');
        }else{
            $data[] = array('result' => 0, 'type' => 'error');
        }
    }else{
        $data[] = array('result' => '', 'type' => 'vacio');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);