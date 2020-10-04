<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['firma'])){
        $firma = $_POST['firma'];
        $folio = $_POST['folio'];
        
        $guarda_firm = $suministro->set_update_firma_plan($firma, $folio);
        
        if ($guarda_firm == true){
            $data[] = array("result"=> $guarda_firm);
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);