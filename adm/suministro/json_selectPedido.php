<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $categorias = $suministro->get_partida($id_pedido);
    $data = array();
    
    foreach ($categorias as $valor){
        $date = new DateTime($valor['fecha_solicitud']);
        $d = $date->format('d');
        $m = $date->format('M');
        $y = $date->format('Y');
        $data[] = array("id_pedido" => $valor["id_pedido"],
                        "autorizado" => $valor["autorizado"],
                        "articulo" => $valor["articulo"],
                        "cantidad" => $valor["cantidad"]." ".$valor["unidad"],
                        "detalle_articulo" => $valor["detalle_articulo"],
                        "justificacion" => $valor["justificacion"],
                        "aprobacion" => $valor["aprobacion"],
                        "anexo_codicion" => $valor["anexo_codicion"],
                        "destino" => $valor["destino"],
                        "status_pedido" => $valor["status_pedido"],
                        "comentario" => "<div class='col-sm-12 form-group'><div class='alert alert-info alert-dismissible fade in' role='alert'><small>Comentario <i class='fa fa-comment'></i></small></br><p id='txt_c'>".$valor["comentario"]."</p></div></div>",
                        "grado_requerimiento" => $valor["grado_requerimiento"],
                        "fecha_requerimiento" => $valor["fecha_requerimiento"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "id_categoria" => $valor["id_categoria"],
                        "categoria" => $valor["categoria"],
                        "folio" => $valor["folio"],
                        "autoriza" => $valor["autoriza"],
                        "comentario2" => is_none($valor["comentario"]),
                        "nombre" => $valor["nombre"]." ".$valor["apellidos"],
                        "fecha_solicitud" => $d." ".$m." ".$y,
                        "especialista"  => "(".$valor["especialista"].")");
    }
    function is_none($val){
        if(is_null($val)){
            return 0;
        }else{
            return $val;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
   