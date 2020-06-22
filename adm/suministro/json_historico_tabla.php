<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_solicitudes_("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cant" => $valor['cantidad'],
                        "coord" => $valor['cantidad_coord'],
                        "plan" => $valor['cantidad_plan'],
                        "surt" => $valor['cantidad_surtido'],
                        "surt_fecha" => $valor['fecha_firm_almacen'],
                        "unidad" => $valor['unidad'],
                        "articulo" => articulo($valor['articulo']),
                        "status" => status_pedido($valor['status_pedido'],$valor['id_pedido']),
                        "equipo" => equipo($valor['nombre_sub_area'],$valor['last_comentario']),
                        "grupo" => grupo($valor['folio'],$valor['nombre_solicitante'],$valor['fecha'],$valor['nombre_generico']),
                        "folio" => $valor['folio']
                        );
    }
    function articulo($articulo){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$articulo</h6>";
    }
    function equipo($equipo,$comentario){
        $info = "";
        if(!empty($comentario)){
            $info = "<i class='icon-info22' title='$comentario'></i>";
        }
        return "<h6 class='mb-0 font-size-sm'><span class='font-weight-bold text-slate-600'>$equipo</span> <span class='text-primary'>$info</span></h6>";
    }
    function grupo($folio,$nombre_solicita,$fecha_sol,$nombre_generico){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'><span class='text-danger-600'>$nombre_generico - </span><span class='text-slate-600'>$nombre_solicita</span></h6>
                <span class='d-block font-size-sm text-blue-800'>$fecha_sol ( Folio: $folio )</span>";
    }
    function status_pedido($status_pedido,$id_pedido){
        $status = "";
        switch ($status_pedido) {
            case 0:
                $status = "<span class='badge badge-flat border-primary text-primary-600 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Nuevo</span>";
                break;
            case 1:
                $status = "<span class='badge badge-success d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Aprobado</span>";
                break;
            case 2:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Cancelado</span>";
                break;
            case 3:
                $status = "<span class='badge bg-purple-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Surtir</span>";
                break;
            case 4:
                $status = "<span class='badge badge-primary d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Completado</span>";
                break;  
            case 5:
                $status = "<span class='badge bg-info-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Compra</span>";
                break;
            case 6:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Anulado</span>";
                break;
         }
        
        return $status;
    }
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>
                <div class='font-size-sm text-muted line-height-1'>$unidad</div>";
    }
    function articulo_marca($articulo,$marca){
        $articulo_ = mb_strtoupper($articulo);
        $marca_ = mb_strtoupper($marca);
        if(!empty($marca_)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$articulo_</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $marca_</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$articulo_</a>
                        </div>
                    </div>";
        }
    }
    function serie_inventario($no_serie,$no_inventario){
        if(!empty($no_serie)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$no_inventario</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $no_serie</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$no_inventario</a>
                        </div>
                    </div>";
        }
    }
    function stock_min_max($cantidad){
        return "<h6 class='mb-0'>$cantidad</h6>";
    }
    function accion($cod_articulo,$no_inventario){
        $inv = "";
        if(empty($no_inventario)){
            $inv = "<a class='dropdown-item' data-codarticulo='$cod_articulo' onclick='inventarear(event)' id='inv_$cod_articulo'><i class='icon-price-tag2'></i> Inventariar</a>";
        }
    return "<div class='list-icons'>
                <div class='dropdown'>
                        <a href='#' class='list-icons-item' data-toggle='dropdown'>
                            <i class='icon-menu7'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right bg-slate-600'>
                            <a class='dropdown-item'><i class='icon-clippy'></i> Propiedades</a>
                            $inv
                        </div>
                </div>
        </div>";
    }
    function costo($costo){
        if(!empty($costo)){
            $moneda = number_format($costo, 2, ',', ' ');
            return "<h6 class='font-weight-semibold text-primary-800 mb-0'>$ $moneda</h6>";
        }else{
            return "";
        }
    }
    function detalle_solicitud($nombre_categoria){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
    }
    function status_disponible($stock){
        if($stock == 1){
            return "<span class='badge bg-success align-self-start ml-3'>Disponible</span>";
        }else{
            return "<span class='badge bg-slate-300 align-self-start ml-3'>Disponible</span>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);