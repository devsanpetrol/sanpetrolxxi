<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
    
    if(!empty ($_POST['data'])){
        $datos = json_decode(stripslashes($_POST['data']));
        $id_empleado = $_POST['responsable'];
        $fecha = $_POST['fecha'];
        
        foreach($datos as $d){
            $responsable = $suministro ->get_nombre_personal($id_empleado);
            $t = $suministro -> set_new_trazabilidad($fecha, "Asignación de Material/Equipo", $responsable, "Base Sanpetrol Villahermosa", "Asignación de Material", $d);
            $a = $suministro -> set_asignacion($d, $id_empleado, $fecha);
            if($t == 0){
                $data[] = array('type' => 'error', 'cod_articulo' => $d,'segmento' => 'Trazabilidad');
            }
            if($a == 0){
                $data[] = array('type' => 'error', 'cod_articulo' => $d,'segmento' => 'Asignación');
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