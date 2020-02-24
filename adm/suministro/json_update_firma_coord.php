<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['firma'])){
        $firma = $_POST['firma'];
        $folio = $_POST['folio'];
        $column_firm = $_POST['column_firm'];
        $column_date = $_POST['column_date'];
        
        $guarda_firm = $suministro->set_update_firma($firma, $folio, $column_firm, $column_date);
        
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