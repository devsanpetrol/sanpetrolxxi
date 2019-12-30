<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $cod_articulo  = $_POST['cod_articulo'];
    $cod_articulo_new  = $_POST['cod_articulo_new'];
    $no_serie = $_POST['no_serie'];
    $no_inventario = $_POST['no_inventario'];
    
    $pedido  = $suministro->set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie);
    
    $data[] = array("res" => $pedido);
    
    header('Content-Type: application/json');
    echo json_encode($data);