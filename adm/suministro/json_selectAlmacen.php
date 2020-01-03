<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_almacen("WHERE no_inventario = ''");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cod_articulo" => $valor['cod_articulo'],
                        "no_inventario" => serie_inventario($valor['no_serie'],$valor['no_inventario']),
                        "descripcion" => articulo_marca($valor['descripcion'],$valor['marca']),
                        "tipo_unidad" => $valor['tipo_unidad'],
                        "stock" => cantidad_unidad($valor['stock'],$valor['tipo_unidad']),
                        "stock_min" => stock_min_max($valor['stock_min']),
                        "stock_max" => stock_min_max($valor['stock_max']),
                        "marca" => $valor['marca'],
                        "costo" => costo($valor['costo']),
                        "nombre_categoria" => nombre_categoria($valor['nombre_categoria']),
                        "accion" => accion($valor['cod_articulo'],$valor['no_inventario'],$valor['tipo_unidad'])
                        );
        
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
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-slate-300 mr-1'></span> $marca_</div>
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
    function accion($cod_articulo,$no_inventario,$tipo_unidad){
        $inv = "";
        if(empty($no_inventario) && $tipo_unidad != "kgr" && $tipo_unidad != "mtr" && $tipo_unidad != "ltr" ){
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
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>
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
    function nombre_categoria($nombre_categoria){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);