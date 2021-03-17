<?php
    require_once './suministro.php'; 
    
    $data = array();
    
    if(!empty($_POST['id_proveedor']) && !empty($_POST['id_proveedor_nuevo'])){
        $suministro = new suministro();
        $articulos  = $suministro->update_factura_proveedor_homologar($_POST['id_proveedor'],$_POST['id_proveedor_nuevo']);
        
        if($articulos){
            $data[] = array("result"=>"ok");
        }else{
            $data[] = array("result"=>"error");
        }
    }else{
        $data[] = array("result"=>'vacio');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);