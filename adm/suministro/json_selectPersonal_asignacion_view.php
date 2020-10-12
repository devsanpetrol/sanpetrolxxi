<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $data = array();
    
    if(!empty($_POST["id_empleado"])){
        $search = $_POST["id_empleado"];
        $solicitud = $catalogo -> get_asignacion_("WHERE id_empleado = $search");
        
        foreach ($solicitud as $valor) {
        $data[] = array("articulo" => articulo($valor['descripcion'],$valor['cod_articulo']),
                        "fecha_recibe" => fecha($valor['fecha_recibe']),
                        "status" => status_asig($valor['fecha_entrega'], $valor['status']),
                        "accion" => accion($valor['id_asignacion'])
                        );
        }
    }
    
    function accion($id_asignacion){
        return "<div class='list-icons'>
                <div class='dropdown'>
                        <a href='#' class='list-icons-item' data-toggle='dropdown'>
                            <i class='icon-menu7'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right bg-primary-600'>
                            <a class='dropdown-item' onclick='openModalDetail($id_asignacion)'><i class='icon-clippy'></i> Detalles</a>
                            <a class='dropdown-item' onclick='openModalDetail($id_asignacion)'><i class='icon-enter5'></i> Devolución de Material</a>
                        </div>
                </div>
        </div>";
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
    function fecha($text){
        $cadena = $text;
        $timestamp = strtotime($cadena);
        $fecha =  date('d F', $timestamp);
        
        //printf('%d años, %d meses, %d días', $fecha3->y, $fecha3->m, $fecha3->d);
        return "<h6 class='mb-0 font-size-sm font-weight-semibold'>$fecha</h6>".antiguedad($text);
    }
    function antiguedad($text){//return "<span>Ant.: $fecha3->y años, $fecha3->m meses, $fecha3->d días</span>";
        $fecha1 = new DateTime($text);
        $fecha2 = new DateTime(date("Y-m-d H:i:s"));
        $fecha3 = $fecha1->diff($fecha2);
        
        $año = $fecha3 -> y;
        $mes = $fecha3 -> m;
        $dia = $fecha3 -> d;
        if($año > 0){
            if($año > 1 && $mes > 1){
                return "<span>Ant.: $año años y $mes meses";
            }else if($año > 1 && $mes <= 1){
                return "<span>Ant.: $año años";
            }
        }else if($año = 0 && $mes > 0){
            if($mes > 1 && $dia > 1){
                return "<span>Ant.: $mes meses y $dia dias";
            }else if($mes > 1 && $dia <= 1){
                return "<span>Ant.: $mes meses";
            }
        }else if($año = 0 && $mes = 0){
            if($dia > 1 ){
                return "<span>Ant.: $dia dias";
            }else if($dia = 0){
                return "<span>Ant.: 1 dia";
            }
        }
        
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