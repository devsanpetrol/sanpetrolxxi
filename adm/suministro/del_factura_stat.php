<?php
    require_once './suministro.php';
    
    $suministro = new suministro();
    $id_factura = $_POST['id_factura'];
    $stat_fact = $suministro->get_status_affects_factura($id_factura);
    $items_fact = $suministro -> get_items_factura($id_factura);
    $cantidad_result = $stat_fact[0]["ct"];
    $data = array();
    
    if($cantidad_result >= 1 ){
        if($stat_fact[0]["tc"] == $stat_fact[0]["tr"] ){
            $delete = $suministro->delete_factura($id_factura);
            
            if($delete){
                foreach ($items_fact as $valor) {
                    $suministro -> update_item_factura($valor['cod_articulo'],$valor['cantidad']);
                }
                $stat = "realizado";
            }else{
                $stat = "error";
            }
            $data[] = array(
                "resultado" => "Adelante. Eliminemos esa factura!",
                "cantidad" => $stat_fact[0]["tc"],
                "restante" => $stat_fact[0]["tr"],
                "status" => $stat
            );
        }else{
            $data[] = array(
                "resultado" => "Lo sentimos. Los items de esta factura ya fueron procesados, no es posible revertir y eliminar.",
                "cantidad" => $stat_fact[0]["tc"],
                "restante" => $stat_fact[0]["tr"],
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