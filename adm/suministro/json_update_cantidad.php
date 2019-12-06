<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
        $cantidad = $_POST['cantidad'];
        
        $detalle_pedido = $suministro->get_partida($id_pedido);
        
        $cantidad_apartado = $detalle_pedido[0]["cantidad_apartado"];
        $cantidad_compra   = $detalle_pedido[0]["cantidad_compra"];
        $cod_articulo      = $detalle_pedido[0]["cod_articulo"];
        
        if($cantidad <= $cantidad_apartado){
            $cantidad_apartado = $cantidad;
            $cantidad_compra = ($cantidad - $cantidad_apartado)*(-1);
            if($cantidad_compra < 0){
                $cantidad_compra = 0;
            }
        }else{
            $cantidad_compra = ($cantidad - $cantidad_apartado);
        }
        
        $set_update_pedido  = $suministro->set_update_cantidad($id_pedido, $cantidad, $cantidad_apartado, $cantidad_compra);
        if ($set_update_pedido == true){
            $data[] = array("result"=>'exito',"cantidad"=>$cantidad);
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);