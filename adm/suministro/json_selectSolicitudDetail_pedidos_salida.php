<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_solicitudes_("WHERE folio = $folio and status_pedido in (1,4) ");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_pedido = $valor["id_pedido"];
        $data[] = array("id_pedido" => $id_pedido,
                        "articulo" => articulo($valor["articulo"],$id_pedido,$valor["unidad"],$valor["cod_articulo"],$valor["justificacion"],$valor["cantidad"]),
                        "cantidad" => cantidad_user($valor["cantidad_pendiente"],$valor["cantidad_surtido"],$valor["cantidad_plan"]),
                        "unidad" => unidad($valor["unidad"]),
                        "justificacion" => detalle($valor["justificacion"],$valor["nombre_sub_area"]),
                        "destino" => $valor["destino"],
                        "status_pedido" => status_pedido($valor["status_pedido"],$id_pedido),
                        "fecha_requerimiento" => $valor["fecha_requerimiento"],
                        "cantidad_plan" => cantidad_plan($valor["cantidad_plan"]),
                        "cantidad_surtido" => $valor["cantidad_surtido"],
                        "cantidad_pendiente" => $valor["cantidad_pendiente"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "last_comentario" => $valor["last_comentario"],
                        "count_comentario" => $valor["count_comentario"],
                        "cantidad_surtir" => cantidad_surtir($id_pedido,$valor["cod_articulo"],$valor["cantidad_plan"],$valor["cantidad_surtido"],$valor["cantidad_plan"]),
                        "id_sub_area" => $valor["id_sub_area"]
                    );
    }
    function cantidad($id_pedido, $cantidad){
        return "<input type='text' class='form-control font-weight-semibold text-center input-cantidad-coord' id='cantidad_$id_pedido' data-idpedido='$id_pedido' placeholder='0' onkeypress='mybind(event)' onkeyup='mayus(this);' value='$cantidad'>";
    }
    function unidad($unidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$unidad</h6>";
    }
    function cantidad_user($cant,$cant_surtido,$cant_plan){
        if($cant_surtido == $cant_plan ){
            return "<h6 class='mb-0 font-size-sm font-weight-bold'>$cant_surtido</h6>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold'>$cant</h6>";
        }
    }
    function cantidad_plan($cant_plan){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$cant_plan</h6>";
    }
    function cantidad_surtir($id_pedido,$cod_articulo,$cantidad,$cant_surtido,$cant_plan){
        if($cant_surtido != $cant_plan ){
            return "<input type='text' class='form-control font-weight-semibold text-center input-cantidad-surtir $cod_articulo' id='cantidad_$id_pedido' data-idpedido='$id_pedido' data-maximo = '$cantidad' data-codarticulo='$cod_articulo' onkeypress='mybind(event)' onkeyup='mayus(this);' value='0' readonly>";
        }else{
            return "";
        }
        
    }
    function articulo($articulo,$id_pedido,$unidad,$cod_articulo,$justificacion,$cantidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$articulo</h6><span class='d-block font-size-xs'>$cod_articulo</span>";
    }
    function justificacion($justificacion){
        return "<h6 class='mb-0 font-size-sm'>$justificacion</h6>";
    }
    function detalle($justificacion,$destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$destino </h6>
                <span class='d-block font-size-xs'>$justificacion</span>";
    }
    function status_pedido($status_pedido,$id_pedido){
        $status = "";
        switch ($status_pedido) {
            case 0:
                $status = "<span class='badge badge-flat border-primary text-primary-600 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Nuevo</span>";
                break;
            case 1:
                $status = "<span class='badge badge-success d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Aprobado</span>";
                break;
            case 2:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Cancelado</span>";
                break;
            case 3:
                $status = "<span class='badge bg-purple-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Surtir</span>";
                break;
            case 4:
                $status = "<span class='badge badge-primary d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Completado</span>";
                break;  
            case 5:
                $status = "<span class='badge bg-info-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Compra</span>";
                break;
            case 6:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Anulado</span>";
                break;
         }
        
        return $status;
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);