<?php
    require_once './suministro.php'; 
    
    $id_compra_lista = $_POST['id_compra_lista'];
    $suministro = new suministro();
    $pedidos = $suministro->get_solicitud_aprobacion_compra_datos_firma($id_compra_lista);
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_valesalida_pedido = $valor["id_compra_lista"];
        $data[] = array("id_compra_lista" => $id_valesalida_pedido,
                        "cantidad_compra" => cantidad_compra($id_compra_lista, $valor["cantidad_comprar"],$valor["cantidad_aprobada"],$valor["aprobado"],$valor["unidad"]),
                        "unidad" => unidad($valor["unidad"]),
                        "id_pedido" => $valor["id_pedido"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "articulo" => articulo($valor["articulo"]),
                        "destino" => destino($valor["destino"]),
                        "autorizacion" => autorizacion($valor["id_pedido"],$valor["cod_articulo"],$valor["cantidad_comprar"],$id_valesalida_pedido,$valor["aprobado"],$valor["cantidad_cancelada"]),
                        "justificacion" => justificacion($valor["justificacion"]));
    }
    function cantidad_compra($id_compra_lista, $cantidad_comprar,$cantidad_aprobada,$aprobado,$unidad){
        if($aprobado < 0){
            return "<div class='input-group'>
                        <input id='number_$id_compra_lista' data-idpedido='$id_compra_lista' data-apartado='$cantidad_comprar' type='number' value='$cantidad_comprar' max='$cantidad_comprar' min='0' class='form-control form-control-lg text-danger font-weight-bold text-center input-surtido-genera' style=''>
                    </div>
                    <div class='progress' style='height: 0.375rem;'>
                            <div class='progress-bar progress-bar-striped bg-success' id='progress_$id_compra_lista' style='width: 100%'></div>
                    </div>
                    <span class='font-size-sm font-weight-bold text-slate-700'>
                        $unidad
                    </span>";
        }else{
            return "<h5 class='mb-0 font-size-sm font-weight-bold text-danger-800'>$cantidad_comprar</h5>";
        }
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
        /*if( $aprobado == 1 ){
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
        }*/
        return "<div class='d-block form-text text-center'>
                        <i class='icon-hour-glass2 text-blue'></i>
                    </div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);