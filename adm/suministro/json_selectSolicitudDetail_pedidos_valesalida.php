<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_select_query_("SELECT * FROM adm_view_valesalida_detail WHERE folio_vale_salida = $folio");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_pedido = $valor["id_valesalida_pedido"];
        $data[] = array("articulo" => detalle($valor["cod_articulo"],$valor["articulo"]),
                        "justificacion" => detalle($valor["justificacion"],$valor["nombre_sub_area"]),
                        "cantidad_surtida" => $valor["cantidad_surtida"],
                        "unidad" => unidad($valor["unidad"]),
                        "recibe" => recibe($valor["id_valesalida_pedido"], $valor["recibe"],$valor["status_surtido"],$valor["cantidad_surtida"]),
                        "status_surtido" => status_pedido($valor["status_surtido"],$id_pedido,$valor["cantidad_surtida"],$valor["id_pedido"])
                    );
    }
    function recibe($id_valesalida_pedido, $recibe, $status_surtido,$cantidad_surtir){
        if($status_surtido == 0){
            return "<input type='text' class='form-control font-weight-semibold input-recibidores' data-idpedidovalesalida='$id_valesalida_pedido' data-cantidadsurtida='$cantidad_surtir' onkeyup='mayus(this);'>";
        }else if($status_surtido == 1){
            return "<span class='badge badge-success d-block'>Entregado</span><h6 class='mb-0 font-size-xs text-center'>$recibe</h6>";
        }
    }
    function unidad($unidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$unidad</h6>";
    }
    function articulo($articulo){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$articulo</h6>";
    }
    function justificacion($justificacion){
        return "<h6 class='mb-0 font-size-sm'>$justificacion</h6>";
    }
    function detalle($justificacion,$destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$destino </h6>
                <span class='d-block font-size-sm text-blue-800'>$justificacion</span>";
    }
    function status_pedido($status_pedido,$id_pedido_vale,$cantidad_surtida,$id_pedido){
        $status = "";
        switch ($status_pedido){
            case 0:
                $status = "<button type='button' class='btn btn-sm alpha-primary text-primary-800 legitRipple btn-icon ml-1' data-idpedido='$id_pedido' data-idpedidovale='$id_pedido_vale' data-cantidadsurtida='$cantidad_surtida' onclick='guarda_entrega($id_pedido_vale)' title='Aplicar entrega OK'><i class='icon-stamp'></i></button>";
                break;
            case 1:
                $status = "<span class='badge badge-success d-block'>Completado</span>";
                break;
        }
        return $status;
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);