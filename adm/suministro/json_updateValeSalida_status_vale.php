<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['folio_vale_salida'])){
        
        $folio_vale_salida = $_POST['folio_vale_salida'];
        $recibe = $_POST['recibe_vale'];
        $status = $_POST['status_vale'];

        $guarda  = $suministro -> set_update_valesalida_detail_status_vale($folio_vale_salida, $recibe, $status);
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