<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_solicitudesTR();
    $x = "";
    $d = array();
    
    foreach ($categorias as $z) {
        $x .= pedido($z["folio"]).$z["leido"];
    }
    $d[] = array("p" => $x);
    function pedido($f){
        $suministro = new suministro();
        $p = $suministro->get_pedidosTR($f);
        $c ="";
        foreach($p as $v){
                $c .= $v['cantidad'].$v['status_pedido'];
            }
        return $c;
    }
    header('Content-Type: application/json');
    echo json_encode($d);
    
    