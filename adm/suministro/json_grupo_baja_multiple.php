<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['data'])){
        $datos = json_decode(stripslashes($_POST['data']));
        $comentario = $_POST['comentario'];
        $responsable = $_POST['responsable'];
        $fecha = $_POST['fecha'];
        
        foreach($datos as $d){
            $r = $suministro -> grupos_baja_agrupo($d,$fecha);
            $t = $suministro -> set_new_trazabilidad($fecha, $comentario, $responsable, "Base Sanpetrol Villahermosa", "Baja a Equipo/Material", $d);
            if($r == 0){
                $data[] = array('type' => 'error', 'cod_articulo' => $d, 'segmento' => 'Baja');
            }
            if($t == 0){
                $data[] = array('type' => 'error', 'cod_articulo' => $d, 'segmento' => 'Trazabilidad');
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