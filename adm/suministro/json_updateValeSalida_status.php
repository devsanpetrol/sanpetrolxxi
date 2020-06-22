<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['idpedidovalesalida'])){
        
        $idpedidovalesalida = $_POST['idpedidovalesalida'];
        $recibe = $_POST['recibe'];
        $status = $_POST['status'];

        $guarda  = $suministro -> set_update_valesalida_detail_status($idpedidovalesalida, $recibe, $status);
        if ($guarda == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'fallo');
        }
    }else{
            $data[] = array("result"=>'no_dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);