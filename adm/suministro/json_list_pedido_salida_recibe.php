<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_partida_detail($folio);
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_valesalida_pedido = $valor["id_valesalida_pedido"];
        $data[] = array("id_valesalida_pedido" => $id_valesalida_pedido,
                        "cantidad_surtir" => cantidad_surtir($id_valesalida_pedido, $valor["cantidad_aprobada"],$valor["aprobado"],$valor["unidad"]),
                        "cantidad_surtir_num" => $valor["cantidad_aprobada"],
                        "unidad" => unidad($valor["unidad"]),
                        "id_pedido" => $valor["id_pedido"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "articulo" => articulo($valor["articulo"]),
                        "destino" => destino($valor["destino"]),
                        "autorizacion" => autorizacion($valor["id_pedido"],$valor["cod_articulo"],$valor["cantidad_aprobada"],$id_valesalida_pedido,$valor["aprobado"],$valor["cantidad_cancelado"]),
                        "recibe" => recibe($id_valesalida_pedido,$valor["recibe"]));
    }
    function cantidad_surtir($id_valesalida_pedido, $cantidad_surtida,$aprobado,$unidad){
        if($aprobado == 0){
            return "<div class='input-group'>
                        <input id='number_$id_valesalida_pedido' data-idpedido='$id_valesalida_pedido' data-apartado='$cantidad_surtida' type='number' value='$cantidad_surtida' max='$cantidad_surtida' min='0' class='form-control form-control-lg text-danger font-weight-bold text-center input-surtido-genera' style=''>
                    </div>
                    <div class='progress' style='height: 0.375rem;'>
                            <div class='progress-bar progress-bar-striped bg-success' id='progress_$id_valesalida_pedido' style='width: 100%'></div>
                    </div>
                    <span class='font-size-sm font-weight-bold text-slate-700'>
                        $unidad
                    </span>";
        }else{
            return "<h5 class='mb-0 font-size-sm font-weight-bold text-danger-800'>$cantidad_surtida</h5>";
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
    function autorizacion($id_pedido,$cod_articulo,$cantidad_surtida,$id_valesalida_pedido,$aprobado,$cantidad_cancelado){
        if( $aprobado == 1 ){
            return "<div class='d-block form-text'>
                        <i class='icon-checkmark-circle text-success'></i>
                    </div>";
        }else if( $aprobado == 2 ){
            return "<div class='d-block form-text'>
                        <i class='icon-cross text-danger-800' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 3 ){
            return "<div class='d-block form-text'>
                        <i class='icon-checkmark-circle text-success'></i>
                        <i class='icon-info22 text-primary' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 0 ){
            return "<div class='custom-control custom-control-right custom-checkbox custom-control-inline'>
                        <input type='checkbox' class='custom-control-input' data-cantidadsurtir='$cantidad_surtida' data-idpedido='$id_pedido' data-codarticulo='$cod_articulo' id='$id_valesalida_pedido' checked>
                        <label class='custom-control-label position-static' for='$id_valesalida_pedido'></label>
                    </div>";
        }
    }
    function recibe($id_valesalida_pedido,$recibe){
        return "<div class='form-group-feedback form-group-feedback-right'>
                    <input type='text' class='form-control form-control-sm font-weight-semibold text-pink firma firma-individual' id='$id_valesalida_pedido' value='$recibe' onkeyup='mayus(this);'>
                    <div class='form-control-feedback'>
                        <button type='button' class='btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm'>
                            <i class='icon-pencil3 text-blue-800'></i>
                        </button>
                    </div>
                </div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);