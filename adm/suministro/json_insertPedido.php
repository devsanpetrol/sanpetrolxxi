<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['articulo'])){
        
        $autorizado = $_POST['autorizado'];
        $articulo = $_POST['articulo'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $detalle_articulo = $_POST['detalle_articulo'];
        $justificacion = $_POST['justificacion'];
        $anexo_codicion = $_POST['anexo_codicion'];
        $destino = $_POST['destino'];
        $comentario = $_POST['comentario'];
        $grado_requerimiento = $_POST['grado_requerimiento'];
        $fecha_requerimiento = $_POST['fecha_requerimiento'];
        $cod_articulo = $_POST['cod_articulo'];
        $id_categoria = $_POST['id_categoria'];
        $folio = $_POST['folio'];
        $clave_solicita = $_POST['clave_solicita'];
        $status_pedido =  status($clave_solicita, $id_categoria);
        $cantidad_aparta = $_POST['cantidad_aparta'];
        $cantidad_compra = $_POST['cantidad_compra'];
        
        $articulos  = $suministro->set_pedido($autorizado, $articulo, $cantidad, $unidad, $detalle_articulo, $justificacion, $anexo_codicion, $destino, $status_pedido, $comentario, $grado_requerimiento, $fecha_requerimiento, $cod_articulo, $id_categoria, $folio,$cantidad_aparta,$cantidad_compra);
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
