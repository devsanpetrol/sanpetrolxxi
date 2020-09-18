<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
   
    if(!empty($_POST['id_empleado']) && !empty($_POST['fecha_baja'])){
        $id_empleado = $_POST['id_empleado'];
        $fecha_baja = $_POST['fecha_baja'];
        $comentario_baja = $_POST['comentario_baja'];
                
        $elimina = $suministro->set_delete_personal($id_empleado, $fecha_baja, $cargo, $comentario_baja);
        
        if ($elimina == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);