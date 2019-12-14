<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $folio_vale      = $_POST['folio_vale'];

    $guarda_firma_vobo = $suministro -> set_update_firma_vobo($folio_vale);
    if($guarda_firma_vobo){
        $data[] = array("result" => 'exito');
    }else{
        $data[] = array("result" => $guarda_firma_vobo);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);