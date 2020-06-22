<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido = $_POST['id_pedido'];
        $cod_articulo = $_POST['cod_articulo'];
        $articulo = $_POST['articulo'];
        $unidad = $_POST['unidad'];
        $justifi = $_POST['justifi'];
        $cantidad = $_POST['cantidad'];
        $user = $_POST['user'];
        
        $set_update_pedido  = $suministro->set_update_pedidoDetail($id_pedido, $cod_articulo, $articulo, $unidad,$justifi,$cantidad,$user);
        if ($set_update_pedido == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);