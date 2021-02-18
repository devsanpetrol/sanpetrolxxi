<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['cod_articulo'])){
        $cod_articulo = $_POST['cod_articulo'];
        $id_empleado = $_POST['id_empleado'];
        $fecha = $_POST['fecha'];
        
        $asignacion = $suministro -> set_asignacion($cod_articulo, $id_empleado, $fecha);
        $responsable = $suministro ->get_nombre_personal($id_empleado);
        $trazabilid = $suministro -> set_new_trazabilidad($fecha, "Asignación de Material/Equipo", $responsable, "Base Sanpetrol Villahermosa", "Asignación de Material", $cod_articulo);
        if ($asignacion == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'falla');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
