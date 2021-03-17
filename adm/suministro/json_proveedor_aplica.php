<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_proveedor("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("nombre" => nombre($valor['nombre'],$valor['razon_social']),
                        "actividad_comercial" => rfc($valor['actividad_comercial']),
                        "rfc" => rfc($valor['rfc']),
                        "accion" => accion2($valor['id_proveedor'], $valor['nombre'], $valor['rfc'],$valor['razon_social'])
                        );
    }
    function accion2($id, $nombre, $rfc,$razon_social){
        return "<button type='button' class='btn btn-outline btn-sm bg-pink-400 text-pink-800 btn-icon rounded-round legitRipple' title='Aplicar' data-id='$id' data-nombre='$nombre' data-rfc='$rfc' data-razonsocial='$razon_social' onclick='get_proveedor(event)' data-toggle='modal' data-target='#'><i class='icon-square-down-right' data-id='$id' data-nombre='$nombre' data-rfc='$rfc' data-razonsocial='$razon_social' onclick='get_proveedor(event)'></i></button>";
    }
    function nombre($nombre,$ac){
        $act = trim($ac);
        if(!empty($act)){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre</h6>
                    <div class='text-muted font-size-sm'><span class='badge badge-mark border-grey-400 mr-1'></span>$act</div>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre</h6>";
        }
    }
    function rfc($rfc){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$rfc</h6>";
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