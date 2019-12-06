<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $categorias = $suministro->get_almacen_salida("WHERE adm_view_almacen_salida.id_pedido = ".$id_pedido);
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
                        "cantidad_apartado" => cantidad_apartado($valor['cantidad_apartado'],$valor['unidad']),
                        "cantidad_surtir" => cantidad_surtir($valor['id_pedido'],$valor['cod_articulo'],$valor['cantidad_apartado']),
                        "cantidad_entregado" => cantidad_entregada($valor['cantidad_entregado'],$valor['unidad']),
                        "cantidad_compra" => cantidad_apartado($valor['cantidad_compra'],$valor['unidad']),
                        "destino" => destino($valor['id_pedido'],$valor['destino_detail'],$valor['tipo_destino']),
                        "accion" => accion($valor['id_pedido'])
                        );
        
    }
    function articulo_detail($id_pedido,$articulo, $categoria, $nombre_aprueba, $cargo_aprueba,$cod_articulo,$nombre_solicita){
        return $articulo_detail = "<div class='mb-0'>
                        <h6 class='mb-0 font-size-md font-weight-bold text-blue-800'>$articulo </h6>
                        <div class='d-block font-size-sm text-blue-800'><span class='badge bg-orange'>$cod_articulo</span> $categoria</div>
                        <span class='d-block font-size-sm text-muted'>Solicitó: $nombre_solicita</span>
                        <span class='d-block font-size-sm text-muted'>Aprobó: $nombre_aprueba</span>
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
    function cantidad_surtir($id_pedido, $cod_articulo, $max){
        return "<input id='number_$id_pedido' data-idpedido='$id_pedido' data-apartado='$max' data-codarticulo='$cod_articulo' type='number' value='0' max='$max' min='0' class='form-control form-control-lg text-danger font-weight-bold text-center input-surtido-genera' style='padding-bottom: 5px;'>
                <div class='progress mb-3' style='height: 0.375rem;'>
                    <div class='progress-bar progress-bar-striped progress-bar-animated' id='progress_$id_pedido' style='width: 0%'>
                    </div>
                </div>";
    }
    function cantidad_entregada($cantidad, $unidad){
        return "<h6 class='mb-0 font-weight-bold text-blue-800'>$cantidad </h6><h6 class='mb-0 font-weight-bold text-slate-300 font-size-sm'>$unidad</h6>";
    }
    function cantidad_apartado($cantidad, $unidad){
        return "<h6 class='mb-0 font-weight-bold text-blue-800'>$cantidad </h6><h6 class='mb-0 font-weight-bold text-slate-300 font-size-sm'>$unidad</h6>";
    }
    function destino($id_pedido,$destino,$tipo_detino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800'>$destino </h6>
                <span class='d-block font-size-sm text-muted'>$tipo_detino</span>";
    }
    function fecha($folio,$fecha_sol,$fecha_req, $id_pedido){
        return "<h6 class='mb-0 font-weight-bold text-danger-800'>Folio #$folio</h6>
                <span class='d-block font-size-sm text-blue-800'>Fecha Requerimiento: $fecha_req</span>
                <span class='d-block font-size-sm text-muted'>Fecha Solicitud: $fecha_sol</span>";
    }
    function accion($id_pedido){
        return "<div class='list-icons'>
                    <a href='#' class='list-icons-item text-danger-600 remover-item-pase' data-popup='tooltip' title='Remove' data-container='body' onclick='remover_salida($id_pedido)'>
                        <i class='icon-minus-circle2'></i>
                    </a>
                </div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);