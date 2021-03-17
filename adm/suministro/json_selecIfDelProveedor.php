<?php
    require_once './suministro.php'; 
    
    $data = array();
    
    if(!empty($_POST['id_proveedor'])){
        $suministro = new suministro();
        $articulos  = $suministro->get_prov_no_factura_relacionada($_POST['id_proveedor']);
        
        
        if($articulos == 0){
            $delete = $suministro -> delete_factura_proveedor($_POST['id_proveedor']);
            if ($delete){
                $data[] = array("total"=>"ok");
            }else{
                $data[] = array("total"=>"error");
            }
        }else{
            $data[] = array("total"=>"relaciondado");
        }
    }else{
        $data[] = array("folio"=>'vacio');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);