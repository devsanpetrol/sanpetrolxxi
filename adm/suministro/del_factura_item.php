<?php
    require_once './suministro.php';
    
    $suministro = new suministro();
    $id_factura = $_POST['id_factura'];
    $id_factura_detalle = $_POST['id_factura_detalle'];
    
    $stat_fact = $suministro->get_status_affects_factura_item($id_factura_detalle);
    $data = array();
    
    if($stat_fact[0]["ct"] >= 1 ){
        if($stat_fact[0]["cantidad"] == $stat_fact[0]["restante"] ){
            $delete = $suministro->delete_factura_item($id_factura, $id_factura_detalle);
            $data[] = array(
                "resultado" => "Adelante. Eliminemos este items de la factura!",
                "cantidad" => $stat_fact[0]["cantidad"],
                "restante" => $stat_fact[0]["restante"],
                "status" => "realizado"
            );
        }else{
            $data[] = array(
                "resultado" => "Lo sentimos. El items de esta factura ya fue procesados, no es posible revertir y eliminar.",
                "cantidad" => $stat_fact[0]["cantidad"],
                "restante" => $stat_fact[0]["restante"],
                "status" => "desaprobado"
            );
        }
    }else{
         $data[] = array(
            "resultado" => 0, //Nada que hacer. La factura no existe
            "status" => "fail"
        );
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);