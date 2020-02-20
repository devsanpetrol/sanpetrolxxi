<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
        $cantidad = $_POST['cantidad'];
        $columna = $_POST['columna'];
        
        $guarda_cantidad = $suministro->set_update_cantidad_solicitudDetalle($id_pedido, $cantidad, $columna);
        
        if ($guarda_cantidad == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);