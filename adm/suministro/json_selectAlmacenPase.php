<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();

    $categorias = $suministro->get_select_query_("SELECT *, sum(cantidad_surtido) as total_surtido, sum(cantidad_plan) as total_plan FROM adm_view_solicitud where firm_planeacion > 0 and status_pedido in (1,4) group BY folio");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("folio" => $valor['folio'],
                        "fecha" => fecha($valor['fecha_firm_planeacion']),
                        "nombre_generico" => $valor['nombre_generico'],
                        "nombre_solicitante" => $valor['nombre_solicitante'],
                        "avance" => avance($valor['total_surtido'],$valor['total_plan']),
                        "status" => "<button type='button' class='btn btn-sm alpha-warning text-warning-800 legitRipple  rounded-round btn-icon ml-1' onclick='openModalSolicitudDetail(".$valor['folio'].")'><i class='icon-circle-right2'></i></button>"
                        );
        
    }
    function avance($total_surtido,$total_plan){
        $porcentaje = round((100/$total_plan)*$total_surtido,0);
        if($porcentaje >= 100 ){
            return "$porcentaje%<div class='progress mb-3' style='height: 0.375rem;'>
                        <div class='progress-bar progress-bar-striped progress-bar bg-primary' style='width: $porcentaje%'></div>
                </div>";
        }else{
            return "$porcentaje%<div class='progress mb-3' style='height: 0.375rem;'>
                        <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: $porcentaje%'></div>
                </div>";
        }
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
    function fecha($fecha){
        $date = new DateTime($fecha);
        return $date->format('F d (ga)');
    }
    function accion($id_pedido){
        return "<div class='list-icons'>
                    <a class='list-icons-item text-danger-600 remover-item-pase' data-popup='tooltip' title='Remove' data-container='body' onclick='remover_salida($id_pedido)'>
                        <i class='icon-minus-circle2'></i>
                    </a>
                </div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);