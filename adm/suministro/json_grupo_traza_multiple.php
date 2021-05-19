<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['data'])){
        $datos = json_decode(stripslashes($_POST['data']));
        $lugar = $_POST['lugar'];
        $condicion = $_POST['condicion'];
        $motivo = $_POST['motivo'];
        $responsable = $_POST['responsable'];
        $fecha = $_POST['fecha'];
        
        foreach($datos as $d){
            $t = $suministro -> set_new_trazabilidad($fecha, $motivo, $responsable, $lugar, $condicion, $d);
            if($t == 0){
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