<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $searchTerm = $_POST["filter"];
    $categorias = $suministro->get_almacen("WHERE descripcion LIKE '%$searchTerm%'");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cod_articulo" => $valor['cod_articulo'],
                        "no_inventario" => serie_inventario($valor['no_serie'],$valor['no_inventario']),
                        "descripcion" => articulo_marca($valor['descripcion'],$valor['marca'],$valor['stock'],$valor['stock_min'],$valor['stock_max']),
                        "tipo_unidad" => $valor['tipo_unidad'],
                        "stock" => status_disponible($valor['stock']),
                        "stock_min" => stock_min_max($valor['stock_min']),
                        "stock_max" => stock_min_max($valor['stock_max']),
                        "marca" => $valor['marca'],
                        "costo" => costo($valor['costo']),
                        "nombre_categoria" => nombre_categoria($valor['nombre_categoria']),
                        "accion" => accion($valor['cod_articulo'],$valor['no_inventario']),
                        "stock2" => stock2($valor['stock'])
                        );
        
    }
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>
                <div class='font-size-sm text-muted line-height-1'>$unidad</div>";
    }
    function articulo_marca($articulo,$marca,$stock, $min, $max){
        $articulo_ = mb_strtoupper($articulo);
        $marca_ = mb_strtoupper($marca);
        $progressBar =progressBar($stock, $min, $max);
        if(!empty($marca_)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$articulo_</h6>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $marca_</div>
                        </div>
                    </div>".$progressBar;
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$articulo_</h6>
                        </div>
                    </div>".$progressBar;
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
    function nombre_categoria($nombre_categoria){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
    }
    function status_disponible($stock){
        if($stock == 1){
            return "<span class='badge bg-success align-self-start ml-3'>Disponible</span>";
        }else{
            return "<span class='badge bg-slate-300 align-self-start ml-3'>Disponible</span>";
        }
    }
    function stock2($stock){
        if($stock > 0){
            return "<div class='list-icons text-primary-800 font-weight-bold'>
                        $stock
                    </div>";
        }else{
            return "<div class='list-icons text-danger-600'>
                        <i class='icon-cross3'></i>
                    </div>";
        }
    }
    function progressBar($stock, $min, $max){
        $progressBar = "<div class='progress-bar' style='width: 0%' title='Sin unidades disponibles'></div>";
        $title = "Agotado. Mínimo requerido: $min";
        $lim_min = lim_min($min, $max);
        
        if( $min > 0 && $max > $min){ //Minimo arriba de 0 y Maximo arriba del Minimo
            $porcent = porcentaje($max, $stock);
            if( $lim_min >= 0 ){
                if( $stock > $max ){ //full_max
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: 100%'></div>";
                    $title = "Stock: Excedente. Por arriba del Máximo de $max unidades";
                }else if($stock > $lim_min && $stock <= $max ){  //full_max
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width: $porcent%'></div>";
                    $title = "Stock: OK! al $porcent%";
                }else if($stock > $min && $stock <= $lim_min ){
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-orange-300' style='width: $porcent%'></div>";
                    $title = "Stock: Casi en el Mínimo de $min unidades";
                }else if($stock > 0 && $stock <= $min){
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: $porcent%'></div>";
                    $title = "Stock: En el Mínimo de $min unidades";
                }
            }
            else{
                if( $stock > $max ){ //full_max
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: 100%'></div>";
                    $title = "Stock: Excedente. Por arriba del Máximo de $max unidades";
                }else if($stock > $min && $stock <= $max ){
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width: $porcent%'></div>";
                    $title = "Stock: OK! al $porcent%";
                }else if($stock > 0 && $stock <= $min ){
                    $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: $porcent%'></div>";
                    $title = "Stock: En el Mínimo de $min unidades";
                }
            }
        }else if( $min > 0 && $max == 0 ){ //Minimo arriba de 0 sin Maximos
            $porcent_min = porcentaje($min, $stock);
            
            if( $stock > $min ){ //full_max
                $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width: 100%'></div>";
                $title = "Stock: OK! Sobre el Mínimo de $min unidades";
            }else if($stock > 0 && $stock <= $min ){  //full_max
                $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: $porcent_min%'></div>";
                $title = "Stock: Bajo el Mínimo de $min unidades";
            }
        }else if( $min <= 0 && $max <= 0 ){ // Sin Minimo y Maximo
            if( $stock > 0 ){ //full_max
                $progressBar = "<div class='progress-bar progress-bar-striped progress-bar-animated bg-orange-300' style='width: 100%'></div>";
                $title = "Máximo y Mínimo sin clasificar";
            }
        }
        return "<div class='progress' style='height: 0.375rem;' title='$title'>
                    $progressBar
                </div>";
    }
    function lim_min($min, $max){ //Alerta Amarilla
        $lim_min = 0;
        if($min > 0){
            if( (($min / 2) + $min) < $max ){
                return $lim_min = ($min / 2) + $min;
            } else if ( (($min / 3) + $min) < $max ) {
                return $lim_min = ($min / 3) + $min;
            } else if ( (($min / 4) + $min) < $max ) {
                return $lim_min = ($min / 4) + $min;
            }
        }
    }
    function porcentaje($total, $parte){
        return round($parte / $total * 100, 2);
    }
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);