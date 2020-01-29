<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_almacen_salida_compra();
    $data = array();
    
    foreach ($categorias as $valor) {
        
        $data[] = array("fecha_solicitud" => fecha($valor['folio'],date('d M h:i a', strtotime($valor['fecha_solicitud'])),date('d M', strtotime($valor['fecha_requerimiento'])),$valor['id_pedido']),
                        "grado_requerimiento" => grado($valor['grado_requerimiento'],date('d F, h:i a', strtotime($valor['fecha_solicitud']))),
                        "folio" => $valor['folio'],
                        "id_pedido" => $valor['id_pedido'],
                        "status_pedido" => $valor['status_pedido'],
                        "cod_articulo" => $valor['cod_articulo'],
                        "articulo" => articulo_detail($valor['id_pedido'],$valor['articulo'], $valor['categoria'], ucwords(mb_strtolower($valor['nombre_aprueba'])), $valor['cargo_aprueba'],$valor['cod_articulo'],ucwords(mb_strtolower($valor['nombre_solicita']))),
                        "cantidad_solicitud" => cantidad_solicitado($valor['cantidad_solicitud'], $valor['unidad']),
                        "cantidad_entregado" => cantidad_entregada($valor['cantidad_entregado'],$valor['unidad']),
                        "cantidad_apartado" => cantidad_entregada($valor['cantidad_apartado'],$valor['unidad']),
                        "cantidad_compra" => cantidad_compra($valor['cantidad_compra'],$valor['unidad']),
                        "destino" => destino($valor['id_pedido'],$valor['destino_detail'],$valor['tipo_destino']),
                        "accion" => accion($valor['id_pedido']),
                        "grupo" => grupo($valor['folio'], $valor['nombre_solicita'],date('d M h:i a', strtotime($valor['fecha_solicitud']))),
                        "auto" => autorizacion2($valor['id_pedido'])
                        );
        
    }
    function articulo_detail($id_pedido,$articulo, $categoria, $nombre_aprueba, $cargo_aprueba,$cod_articulo,$nombre_solicita){
        return $articulo_detail = "<div class='mb-0'>
                        <h6 class='mb-0 font-size-md font-weight-bold text-blue-800 text-uppercase' data-filter ='$articulo' id='art_$id_pedido' onclick='filter_articulo(event)' style='cursor: pointer'>$articulo </h6>
                        <div class='d-block font-size-sm text-blue-800' data-filter ='$categoria' id='cat_$id_pedido' onclick='filter_articulo(event)' style='cursor: pointer'><span class='badge bg-orange'>$cod_articulo</span> $categoria</div>
                        <span class='d-block font-size-sm text-muted' data-filter ='$nombre_aprueba' id='nomapu_$id_pedido' onclick='filter_articulo(event)' style='cursor: pointer'>Aprobó: $nombre_aprueba</span>
                      </div>";
    }
    function grado($grado_requerimiento,$fecha){
        if($grado_requerimiento == "Inmediato"){
            return "<i class='icon-star-full2 mr-3 text-orange-300' data-popup='tooltip' title='Inmediato'></i>";
        }else{
            return "<i class='icon-calendar2 mr-3 text-blue-800' data-popup='tooltip' title='Requerido para: ".$fecha."'></i>";
        }
    }
    function cantidad_solicitado($cantidad, $unidad){
        return "<h6 class='mb-0 font-weight-bold'>$cantidad </h6><h6 class='mb-0 font-weight-bold text-slate-300 font-size-sm'>$unidad</h6>";
    }
    function cantidad_entregada($cantidad, $unidad){
        return "<h6 class='mb-0 font-weight-bold text-blue-800'>$cantidad </h6><h6 class='mb-0 font-weight-bold text-slate-300 font-size-sm'>$unidad</h6>";
    }
    function cantidad_compra($cantidad, $unidad){
        if ($cantidad > 0){
            return "<h6 class='mb-0 font-weight-bold text-danger'>$cantidad </h6><h6 class='mb-0 font-weight-bold text-slate-300 font-size-sm'>$unidad</h6>";
        }
    }
    function destino($id_pedido,$destino,$tipo_detino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800' data-filter ='$destino' id='destino_$id_pedido' onclick='filter_destino(event)' style='cursor: pointer'>$destino </h6>
                <span class='d-block font-size-sm text-muted'>$tipo_detino</span>";
    }
    function fecha($folio,$fecha_sol,$fecha_req, $id_pedido){
        return "<h6 class='mb-0 font-weight-bold text-danger-800' data-filter ='#$folio' id='folio_$id_pedido' onclick='filter_folio(event)' style='cursor: pointer'>Folio #$folio</h6>
                <span class='d-block font-size-sm text-blue-800'>Fecha Req.: $fecha_req</span>";
    }
    function accion3($id_pedido){
        return "<button type='button' class='btn btn-link btn-sm text-blue-800' data-idpedido='$id_pedido' id='btn_acc_$id_pedido' onclick='agrega_pase($id_pedido)'>
                <i class='icon-clipboard4' id='btn_acc_i1$id_pedido'></i>
                <i class='icon-clipboard5' style='display: none;' id='btn_acc_i2$id_pedido'></i>
                    Salida
                </button>";
    }
    function accion($id_pedido){
        return "<div class='custom-control custom-control-right custom-checkbox custom-control-inline'>
                    <input type='checkbox' class='custom-control-input' data-idpedido='$id_pedido' id='btn_acc_$id_pedido' onclick='agrega_pase($id_pedido)'>
                    <label class='custom-control-label position-static' for='btn_acc_$id_pedido'></label>
                </div>";
    }
    function autorizacion2($id_valesalida_pedido){
        return "<div class='custom-control custom-control-right custom-checkbox custom-control-inline'>
                    <input type='checkbox' class='custom-control-input' id='$id_valesalida_pedido'>
                    <label class='custom-control-label position-static' for='$id_valesalida_pedido'></label>
                </div>";
    }
    function grupo($folio,$nombre_solicita,$fecha_sol){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$nombre_solicita </h6>
                <span class='d-block font-size-sm text-blue-800'>$fecha_sol ( Folio: $folio )</span>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);