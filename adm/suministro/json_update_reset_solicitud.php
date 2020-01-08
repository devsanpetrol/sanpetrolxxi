<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $folio_vale = $_POST['folio_vale'];
    
    $guarda_recibe = $suministro ->set_update_reset_solicitud($folio_vale);
    if($guarda_recibe){
        $data[] = array("result" => 'exito');
    }else{
        $data[] = array("result" => $guarda_recibe);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);