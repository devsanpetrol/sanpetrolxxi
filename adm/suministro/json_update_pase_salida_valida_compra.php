<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_compra_lista'])){
        $id_pedido       = $_POST['id_compra_lista'];
        $cantidad_compra = $_POST['cantidad_compra'];
        $cantidad_cancelado = $_POST['cantidad_cancelado'];
        $status          = $_POST['status'];
        
        if ($status == "si"){//resolver
            $set_update_salida_aprobado = $suministro->set_update_compra_aprobado($id_compra_lista, $cantidad_compra, $cantidad_cancelado);
            if($set_update_salida_aprobado){
                $data[] = array("result" => 'exito');
            }else{
                $data[] = array("result" => $set_update_salida_aprobado);
            }
        }
        if($status == "no"){
            $set_update_salida_no_aprovado = $suministro ->set_update_compra_no_aprovado($id_compra_lista);
            if($set_update_salida_no_aprovado){
                $data[] = array("result" => 'exito');
            }else{
                $data[] = array("result" => $set_update_salida_no_aprovado);
            }
        }
    }else{
            $data[] = array("result" => $set_update_salida_no_aprovado);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);