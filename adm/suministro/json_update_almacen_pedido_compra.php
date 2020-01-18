<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['id_pedido'])){
        $id_pedido       = $_POST['id_pedido'];
        $cantidad_comprar= $_POST['cantidad_comprar'];
        $update_almacen  = $_POST['update_almacen'];
        $visto_bueno = $_POST['visto_bueno'];
        $encargado_almacen = $_POST['encargado_almacen'];
        
        $set_update_pedido = $suministro->set_update_salida_compra($id_pedido, $cantidad_comprar, $update_almacen, $visto_bueno, $encargado_almacen);
        if ($set_update_pedido == 1){
            $data[] = array('result' => 'exito');
        }else{
            $data[] = array('result' => $set_update_pedido, 'set_update_pedido' => false);
        }
    }else{
            $data[] = array('result' => 'falla_recepcion_dato','id_pedido' => 'is_empty');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);