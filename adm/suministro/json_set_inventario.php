<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $cod_articulo  = $_POST['cod_articulo'];
    $cod_articulo_new  = $_POST['cod_articulo_new'];
    
    $inventariado = $_POST['inventariado'];
    if($inventariado == "no" && !empty ($_POST['no_inventario'])){
        $no_serie = $_POST['no_serie'];
        $no_inventario = $_POST['no_inventario'];
        $costo = $_POST['costo'];
        $pedido  = $suministro->set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie,$costo);
    }else if($inventariado == "si" && !empty ($_POST['no_inventario'])){
        $no_serie = $_POST['no_serie'];
        $no_inventario = $_POST['no_inventario'];
        $costo = $_POST['costo'];
        $pedido  = $suministro->set_update_new_articulo($cod_articulo_new,$no_inventario,$no_serie,$costo);
    }else if($inventariado == "si" && empty ($_POST['no_inventario'])){
        $pedido  = $suministro->set_delete_new_articulo($cod_articulo_new);
    }
    $data[] = array("res" => $pedido);
    
    header('Content-Type: application/json');
    echo json_encode($data);