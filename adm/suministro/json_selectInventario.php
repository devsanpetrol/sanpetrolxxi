<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_activofijo("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cod_articulo" => $valor['cod_articulo'],
                        "no_inventario" => serie_inventario($valor['no_serie'],$valor['no_inventario']),
                        "descripcion" => articulo_marca($valor['descripcion'],$valor['marca']),
                        "tipo_unidad" => $valor['tipo_unidad'],
                        "status" => status_disponible("Activo","Inactivo",$valor['status'],"success","slate-300"),
                        "disponible" => status_disponible("Disponible","Ocupado",$valor['disponible'],"primary","slate-300"),
                        "operable" => status_disponible("Operable","No Operable",$valor['operable'],"success","danger"),
                        "marca" => $valor['marca'],
                        "costo" => costo($valor['costo']),
                        "nombre_categoria" => nombre_categoria($valor['nombre_categoria']),
                        "accion" => accion($valor['cod_articulo'],$valor['no_inventario'],$valor['id_factura'])
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
    function accion($cod_articulo,$no_inventario,$id_factura){
        $inv  = "";
        $prop = "";
        $fact = "";
        if(empty($no_inventario)){
            $inv = "<a class='dropdown-item' data-codarticulo='$cod_articulo' onclick='inventarear(event)' id='inv_$cod_articulo'><i class='icon-price-tag2'></i> Inventariar</a>";
        }
        if(!empty($cod_articulo)){
            $prop = "<a class='dropdown-item' id='X$cod_articulo' data-codarticulo='$cod_articulo' onclick='propiedadArticle(event)'><i class='icon-clippy'></i> Propiedades</a>";
        }
        if(!empty($id_factura)){
            $fact = "<a class='dropdown-item' id='Z$cod_articulo' data-codarticulo='$cod_articulo' data-idfactura='$id_factura' onclick='openModalFacturaDetail(event)'><i class='icon-certificate'></i> Ver Factura</a>";
        }
    return "<div class='list-icons'>
                <div class='dropdown'>
                    <a href='#' class='list-icons-item' data-toggle='dropdown'>
                        <i class='icon-menu7'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right bg-slate-600'>
                        $prop
                        $inv
                        $fact
                        <a class='dropdown-item' id='Y$cod_articulo' data-codarticulo='$cod_articulo' onclick='openTrazabilidad(event)'><i class='icon-search4'></i> Trazabilidad</a>
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
    function status_disponible($text1,$text2,$status,$color1,$color2){
        if($status == 1){
            return "<span class='badge bg-$color1 align-self-start ml-3'>$text1</span>";
        }else{
            return "<span class='badge bg-$color2 align-self-start ml-3'>$text2</span>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);