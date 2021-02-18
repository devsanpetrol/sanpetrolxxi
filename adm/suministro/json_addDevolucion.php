<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
            
    if(!empty ($_POST['cod_articulo'])){
        $cod_articulo = $_POST['cod_articulo'];
        $fecha = $_POST['fecha'];
        $responsable  = $_POST['responsable'];
        $id_empleado = $_POST['id_empleado'];
        $id_asignacion = $_POST['id_asignacion'];
        $comentario = $_POST['comentario'];
        
        $result = $suministro->upd_asignacion($cod_articulo, $id_asignacion, $id_empleado, $fecha, $responsable, $comentario);
        
        if($result){
            $data[] = array('result' => 'exito', 'type' => 'update');
        }else{
            $data[] = array('result' => 'fallo', 'type' => 'update');
        }
    }else{
        $data[] = array('result' => 'vacio', 'type' => 'update');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);