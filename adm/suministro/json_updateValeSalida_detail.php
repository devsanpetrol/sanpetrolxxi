<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['folio_vale'])){
        
        $folio_vale      = $_POST['folio_vale'];
        $cantidad_surtir = $_POST['cantidad_surtir'];
        $id_pedido       = $_POST['id_pedido'];

        $guarda  = $suministro -> update_vale_salida_detail($folio_vale, $cantidad_surtir, $id_pedido);
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