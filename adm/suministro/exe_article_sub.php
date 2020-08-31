<?php
    require_once './suministro.php'; 
    
    //=================================
    $val_search = 6 ;//$_POST["cantidad"];
    $cod_articulo = 'CON0007' ;//$_POST["cod_articulo"];
    //=================================
    $suministro = new suministro();
    $categorias = $suministro->exe_factura_detalle($cod_articulo);
    $factor = 0;
    //=================================
    
    foreach ($categorias as $valor) {
        $factor  += $valor['restante'];
        $restante = $factor - $val_search;
        if($factor >= $val_search){
            $categorias = $suministro->set_update_almacenArticleSub($valor['id_factura_detalle'], $restante);
            break;
        }else{
            $categorias = $suministro->set_update_almacenArticleSub($valor['id_factura_detalle'], 0);
        }
    }
        
    //header('Content-Type: application/json');
    //echo json_encode($data);