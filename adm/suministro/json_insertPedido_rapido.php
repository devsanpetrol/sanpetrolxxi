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
        $cod_articulo = $_POST['cod_articulo'];
        $folio = $_POST['folio'];
        
        $articulos  = $suministro->set_pedido_rapido($articulo, $cantidad, $unidad, $justificacion, $destino, $cod_articulo,$folio);
        if ($articulos == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'falla');
    }
    function status($clave_solicita, $id_categoria){
        $suministro = new suministro(); $status = 0;
        $articulos  = $suministro->get_responsable_categoria($id_categoria);
        if ($clave_solicita == $articulos) : $status = 1; endif;
        return $status;
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
