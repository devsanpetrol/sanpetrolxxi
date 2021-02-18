<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_factura'])){
        
        $id_factura = $_POST['id_factura'];
        $id_factura_detalle = $_POST['id_detalle_factura'];
        $costo = $_POST['costo'];
        
        $guarda  = $suministro -> set_update_costo_unitario($id_factura,$id_factura_detalle,$costo);
        if ($guarda == true){
            $data[] = array("result"=>'exito',"id"=>$id_factura_detalle);
        }else{
            $data[] = array("result"=>'fallo',"id"=>$id_factura_detalle);
        }
    }else{
        $data[] = array("result"=>'no_dato',"id"=>$id_factura_detalle);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);