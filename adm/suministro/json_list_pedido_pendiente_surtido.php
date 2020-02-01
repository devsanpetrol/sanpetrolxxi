<?php
    require_once './suministro.php'; 
    
    $filtro = "AND id_pedido = " . $_POST['id_pedido'];
    $suministro = new suministro();
    $pedidos = $suministro->get_solicitud_pendiente_surtido($filtro);
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_valesalida_pedido = $valor["id_pedido"];
        $data[] = array("id_compra_lista" => $id_valesalida_pedido,
                        "cantidad_compra" => cantidad_compra($valor["id_pedido"], $valor["cantidad_compra"],$valor["unidad"]),
                        "unidad" => unidad($valor["unidad"]),
                        "id_pedido" => $valor["id_pedido"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "articulo" => articulo($valor["articulo"]),
                        "destino" => destino($valor["destino"]),
                        "autorizacion" => autorizacion($valor["aprobacion"]),
                        "justificacion" => justificacion($valor["justificacion"]));
    }
    function cantidad_compra($id_compra_lista, $cantidad_comprar, $unidad){
        /*if($aprobado < 0){
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
        }*/
        return "<h5 class='mb-0 font-size-sm font-weight-bold text-danger-800'>$cantidad_comprar</h5>";
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
    function autorizacion($aprobado){
        if( $aprobado == 1 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-checkmark-circle text-success'></i>
                    </div>";
        }
        else if( $aprobado == 0 ){return "<div class='d-block form-text text-center'>
                        <i class='icon-hour-glass2 text-blue-800'></i>
                    </div>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);