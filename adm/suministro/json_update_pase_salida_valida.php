<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido       = $_POST['id_pedido'];
        $cod_articulo    = $_POST['cod_articulo'];
        $cantidad_surtir = $_POST['cantidad_surtir'];
        $cantidad_cancelado = $_POST['cantidad_cancelado'];
        $total = $cantidad_surtir + $cantidad_cancelado;
        $status          = $_POST['status'];
        $id_valesalida_pedido = $_POST['id_valesalida_pedido'];
        
        if ($status == "si"){
            $set_update_salida_aprobado = $suministro->set_update_salida_aprobado($id_pedido, $cod_articulo, $cantidad_surtir, $cantidad_cancelado, $id_valesalida_pedido);
            if($set_update_salida_aprobado){
                $data[] = array("result" => 'exito');
            }else{
                $data[] = array("result" => $set_update_salida_aprobado);
            }
        }
        if($status == "no"){
            $set_update_salida_no_aprovado = $suministro ->set_update_salida_no_aprovado($id_pedido, $id_valesalida_pedido,$total);
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