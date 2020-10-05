<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $data = array();
    
    if(!empty($_POST["id_empleado"])){
        $search = $_POST["id_empleado"];
        $solicitud = $catalogo -> get_asignacion_("WHERE id_empleado = $search");
        
        foreach ($solicitud as $valor) {
        $data[] = array("articulo" => articulo($valor['descripcion'],$valor['cod_articulo']),
                        "fecha_recibe" => text($valor['fecha_recibe']),
                        "status" => status_asig($valor['fecha_entrega'], $valor['status'])
                        );
        }
    }
    function status_asig($fecha_entrega,$status){
        if($fecha_entrega == null && $status == 1){
            return $status_r = "<span class='badge d-block badge-success'>Activo</span>";
        }else if($status == 0){
            return $status_r = "<span class='badge d-block badge-info'>Entregado</span>";
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