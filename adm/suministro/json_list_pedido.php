<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_partida_detail2($folio);
    $fecha_actual = substr($suministro->get_now()[0]['fecha_actual'], 0, 11);
    $data = array();
    
    foreach ($pedidos as $valor){
        $comentario_obj = $suministro->get_pedido_comentario($valor["id_pedido"]);
        $date = new DateTime($valor['fecha_requerimiento']);
        $fecha_comen = substr($valor['comentario_fecha'], 0, 11);
        $hora_comen  = date("g:i a",strtotime($valor['comentario_fecha']));
        $d = $date->format('d');
        $m = $date->format('M');
        $y = $date->format('Y');
        $data[] = array("id_pedido" => $valor["id_pedido"],
                        "autorizado" => $valor["autorizado"],
                        "articulo" => $valor["articulo"],
                        "cantidad" => $valor["cantidad"],
                        "cantidad_apartado" => $valor["cantidad_apartado"],
                        "cantidad_entregado" => $valor["cantidad_entregado"],
                        "cantidad_compra" => $valor["cantidad_compra"],
                        "unidad" => $valor["unidad"],
                        "detalle_articulo" => $valor["detalle_articulo"],
                        "justificacion" => $valor["justificacion"],
                        "aprobacion" => $valor["aprobacion"],
                        "anexo_codicion" => $valor["anexo_codicion"],
                        "destino" => $valor["destino"],
                        "status_pedido" => $valor["status_pedido"],
                        "comentario" => $valor["comentario"],
                        "comentario_fecha" => str_replace($fecha_actual, "", $fecha_comen).$hora_comen,
                        "grado_requerimiento" => $valor["grado_requerimiento"],
                        "fecha_requerimiento" => $d."-".$m."-".$y,
                        "cod_articulo" => $valor["cod_articulo"],
                        "id_categoria" => $valor["id_categoria"],
                        "categoria" => $valor["categoria"],
                        "folio" => $valor["folio"],
                        "id_autoriza" => $valor["id_autoriza"],
                        "autoriza" => $valor["autoriza"],
                        "fecha_solicitud" => $valor['fecha_solicitud'],
                        "especialista"  => "");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);