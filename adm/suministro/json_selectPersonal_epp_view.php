<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $data = array();
    
    if(!empty($_POST["id_empleado"])){
        $search = $_POST["id_empleado"];
        $solicitud = $catalogo -> get_solicitudes_("WHERE id_solicita = $search AND id_equipo = 19 AND status_pedido <> 4");
        $surtido   = $catalogo -> get_vale_salida_("WHERE id_solicita = $search AND id_equipo = 19");
        
        foreach ($solicitud as $valor) {
        $data[] = array("articulo" => articulo($valor['articulo'],$valor['cod_articulo']),
                        "fecha" => text($valor['fecha_requerimiento']),
                        "status" => status_epp($valor['cantidad_surtido'], $valor['cantidad_pendiente'], $valor['cantidad_plan'], $valor['status_pedido'])
                        );
        }
        foreach ($surtido as $valor) {
        $data[] = array("articulo" => articulo($valor['articulo'],$valor['cod_articulo']),
                        "fecha" => text($valor['fecha']),
                        "status" => "<span class='badge d-block badge-info'>Entregado</span>"
                        );
        }
    }
    function status_epp($surtido,$pendiente,$plan,$status){
        if($surtido == 0 && $pendiente == 0){
            return $status_r = "<span class='badge d-block badge-primary'>Revisión</span>";
        }else if($status == 2){
            return $status_r = "<span class='badge d-block badge-danger'>Cancelado</span>";
        }else if($status == 1 && $plan == $pendiente){
            return $status_r = "<span class='badge d-block badge-success' title ='Cantidad: $pendiente'>Aprobado</span>";
        }else if($surtido > 0 && $surtido < $pendiente){
            return $status_r = "<span class='badge d-block badge-warning' title='Cantidades surtidas'>$surtido de $pendiente</span>";
        }
    }
    function articulo($articulo,$cod_articulo){
        return "<div class='d-flex align-items-center'>
                    <div>
                        <a class='text-default font-weight-semibold letter-icon-title'>$articulo</a>
                        <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $cod_articulo</div>
                    </div>
                </div>";
    }
    function text($text){
        return "<h6 class='mb-0 font-size-sm font-weight-semibold'>$text</h6>";
    }
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>
                <div class='font-size-sm text-muted line-height-1'>$unidad</div>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);