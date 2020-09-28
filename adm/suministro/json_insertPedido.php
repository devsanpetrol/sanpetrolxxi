<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['articulo'])){
        
        
        $articulo = $_POST['articulo'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $justificacion = $_POST['justificacion'];
        $destino = $_POST['destino'];
        $fecha_requerimiento = $_POST['fecha_requerimiento'];
        $cod_articulo = $_POST['cod_articulo'];
        $folio = $_POST['folio'];
        
        $articulos  = $suministro->set_pedido($articulo, $cantidad, $unidad, $justificacion, $destino, $fecha_requerimiento, $cod_articulo,$folio);
        if ($articulos == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'falla');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
