<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['id_grupo'])){
        $id_grupo = $_POST['id_grupo'];
        $grupo = $_POST['grupo'];
        $tipo = $_POST['tipo'];
        
        if($tipo == "del"){
            $result = $suministro->grupos_eliminar_grupo($id_grupo);
        }else if($tipo == "upd"){
            $result = $suministro->grupos_modificar_grupo($id_grupo, $grupo);
        }
        if($result >= 1){
            $data[] = array('result' => $result, 'type' => 'exito');
        }else{
            $data[] = array('result' => 0, 'type' => 'error');
        }
    }else{
        $data[] = array('result' => '', 'type' => 'vacio');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);