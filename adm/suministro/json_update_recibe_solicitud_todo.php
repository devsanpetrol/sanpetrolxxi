<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $folio_vale = $_POST['folio_vale'];
    $firma_recibe = $_POST['recibe_vale'];
    
    $guarda_recibe = $suministro ->set_update_recibe_solicitud_todo($folio_vale, $firma_recibe);
    if($guarda_recibe){
        $data[] = array("result" => 'exito');
    }else{
        $data[] = array("result" => $guarda_recibe);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);