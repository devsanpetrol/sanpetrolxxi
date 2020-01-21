<?php
    require_once './suministro.php';
    
    $suministro = new suministro();
    $filtro = "WHERE aprobado IN ( 2 )";
    $categorias = $suministro->get_solicitud_aprobacion_compra($filtro);
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha_inicial']);
        $d = $date->format('d');
        $m = $date->format('M');
        $folio = $valor['id_compra_lista'];
        $star = "<a href='#'>#$folio</a>";
        $foto = "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/placeholder.jpg' class='rounded-circle' width='32' height='32' alt=''></a>";
        
        $data[] = array("star" => $star,
                        "pedidos" => pedido($valor['cantidad_comprar'],$valor['cantidad_aprobada'],$valor['cantidad_cancelada'],$valor['aprobado'],$valor['articulo'],$valor['unidad'],$valor['destino'],$valor['justificacion']),
                        "fecha" => $m." ".$d,
                        "revisado" => revisado($valor['aprobado']),
                        "folio" => $folio,
                        "justificacion" => $folio,
                        "status_vale" => $valor['aprobado'],
                        "grupo" => grupo($valor['aprobado'])
                        );
    }
    function pedido($cantidad_comprar,$cantidad_aprobada,$cantidad_cancelado,$aprobado_status,$articulo,$unidad,$destino,$justificacion){
        $cantidad = cantidad_alter($cantidad_comprar,$cantidad_aprobada,$cantidad_cancelado,$aprobado_status);
        $aprobado = aprobado($aprobado_status);
        return " <span class='table-inbox-subject'>$aprobado ($cantidad $unidad) $articulo &nbsp;&nbsp;</span><span class='badge badge-flat border-grey text-grey-600'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span>";
    }
    function cantidad_alter($cantidad_surtir,$cantidad_aprobado,$cantidad_cancelado,$status_vale){
        if($status_vale == 0){
            return $cantidad_surtir;
        }elseif($status_vale == 1){
            return $cantidad_aprobado;
        }else if($status_vale == 2){
            return $cantidad_cancelado;
        }
    }
    function revisado($status_vale){
        if($status_vale >= 1){
            return "<div class='d-block form-text text-center text-slate'>
                        <i class='icon-clipboard2'></i>
                    </div>";
           
        }else{
             return "<div class='d-block form-text text-center text-indigo-800'>
                        <i class='icon-clipboard'></i>
                    </div>";
        }
    }
    function aprobado($aprobado){
        if($aprobado == 1 || $aprobado == 3){
            return "<i class='icon-checkmark2 text-success-800'></i>";
        }else if($aprobado == 2){
            return "<i class='icon-cross text-danger-800'></i>";
        }else{
            return "<span class='badge badge-mark bg-info-400 border-info-400'></span>";
        }
    }
    function grupo($status){
        if($status == 0){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>SIN REVISIÓN</h6>";
        }elseif($status == 1){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'><i class='icon-cart-add2 text-pink-700 mr-2'></i> ENVIADOS A COMPRA</h6>";
        }elseif($status == 2){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-danger-600'><i class='icon-cross3 text-danger-700 mr-2'></i> COMPRAS CANCELADAS</h6>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    