<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['nuevo_grupo'])){
        $nuevo_grupo = $_POST['nuevo_grupo'];
        
        $id_nuevo_grupo = $suministro->set_nuevo_grupo($nuevo_grupo);
        
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