<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_solicitudes_("WHERE folio = $folio");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_pedido = $valor["id_pedido"];
        $data[] = array("id_pedido" => $id_pedido,
                        "articulo" => $valor["articulo"],
                        "cantidad" => $valor["cantidad"],
                        "unidad" => $valor["unidad"],
                        "justificacion" => $valor["justificacion"],
                        "destino" => $valor["destino"],
                        "status_pedido" => $valor["status_pedido"],
                        "fecha_requerimiento" => $valor["fecha_requerimiento"],
                        "cantidad_coord" => cantidad($id_pedido, $valor["cantidad_coord"]),
                        "cantidad_plan" => $valor["cantidad_plan"],
                        "cantidad_surtido" => $valor["cantidad_surtido"],
                        "cantidad_pendiente" => $valor["cantidad_pendiente"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "nombre_sub_area" => $valor["nombre_sub_area"],
                        "id_sub_area" => $valor["id_sub_area"]
                    );
    }
    function cantidad($id_pedido, $cantidad){
        return "<input type='text' class='font-weight-semibold text-blue-800 text-center input-cantidad-coord' id='cantidad_$id_pedido' data-idpedido='$id_pedido' placeholder='0' onkeypress='mybind(event)' onkeyup='mayus(this);' value='$cantidad'>";
    }
    function unidad($unidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-700'>$unidad</h6>";
    }
    function destino($destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-700'>$destino</h6>";
    }
    function articulo($articulo){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800'>$articulo</h6>";
    }
    function justificacion($justificacion){
        return "<h6 class='mb-0 font-size-sm text-slate-700'>$justificacion</h6>";
    }
    function autorizacion($id_pedido,$cod_articulo,$cantidad_comprar,$id_compra_lista,$aprobado,$cantidad_cancelado){
        if( $aprobado == 1 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-checkmark-circle text-success'></i>
                    </div>";
        }else if( $aprobado == 2 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-cross text-danger-800' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 3 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-checkmark-circle text-success'></i>
                        <i class='icon-info22 text-primary' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 0 ){
            return "<div class='custom-control custom-control-right custom-checkbox custom-control-inline'>
                        <input type='checkbox' class='custom-control-input' data-cantidadsurtir='$cantidad_comprar' data-idpedido='$id_pedido' data-codarticulo='$cod_articulo' data-idcompralista='$id_compra_lista' id='A$id_compra_lista' checked>
                        <label class='custom-control-label position-static' for='A$id_compra_lista'></label>
                    </div>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);