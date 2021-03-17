<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_proveedores();
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("actividad" => nombre_categoria($valor['actividad_comercial']),
                        "rfc" => txtsmall($valor['rfc']),
                        "id_proveedor" => $valor['id_proveedor'],
                        "nombre_rfc" => articulo_marca($valor['nombre'],$valor['razon_social']),
                        "direccion" => articulo_marca($valor['direccion'],$valor['codigo_postal']),
                        "telefono" => txtsmall($valor['num_telefono']),
                        "email" => articulo_marca($valor['email'],"Tel: ".$valor['num_telefono']),
                        "contacto" => txtsmall($valor['detalle_contacto']),
                        "select_proveedor"=> selectProv($valor['rfc'],$valor['nombre'],$valor['razon_social']),
                        "menu" => accion($valor['id_proveedor'],$valor['nombre'])
                        );
        
    }
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>";
    }
    function selectProv($rfc,$nombre,$razon_social){
        if($rfc != ""){
        $rfc = $rfc." - ";}else{$rfc = "";}
        if($razon_social != ""){
        $razon_social = " (".$razon_social.")";}else{$razon_social = "";}
        return $rfc.$nombre.$razon_social;
    }
    function articulo_marca($articulo,$marca){
        $articulo_ = mb_strtoupper($articulo);
        $marca_ = mb_strtoupper($marca);
        if(!empty($marca_)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='mb-0 font-size-sm font-weight-bold text-primary-800'>$articulo_</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $marca_</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='mb-0 font-size-sm font-weight-bold text-primary-800'>$articulo_</a>
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
    function accion($id_proveedor,$nombre){
        
    return "<div class='list-icons'>
                <div class='dropdown'>
                        <a href='#' class='list-icons-item' data-toggle='dropdown'>
                            <i class='icon-menu7'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right bg-slate-600'>
                            <a class='dropdown-item' data-idproveedor='$id_proveedor' data-nombre='$nombre' id='pro_$id_proveedor' onclick='openEditProveedor(event)'><i class='icon-pencil3'></i>Editar</a>
                            <a class='dropdown-item' data-idproveedor='$id_proveedor' data-nombre='$nombre' id='del_$id_proveedor' onclick='openDeleProveedor(event)'><i class='icon-cross2'></i>Eliminar</a>
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
        if($nombre_categoria == ""){
            return "<h6 class='mb-0 font-size-sm font-weight-bold'></h6>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
        }
        
    }
    function txtsmall($txt){
        return "<h6 class='mb-0 font-size-sm font-weight-semi-bold'>$txt</h6>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    //<div class='dropdown-divider'></div>
        //<a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>