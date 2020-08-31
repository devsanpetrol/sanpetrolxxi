<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_articulo_detail("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("descripcion" => nombre($valor['descripcion'],$valor['marca']),
                        "cod_articulo" => rfc($valor['cod_articulo']),
                        "categoria" => rfc($valor['nombre_categoria']),
                        "accion" => accion2($valor['cod_articulo'])
                        );
    }
    function accion2($nombre){
        return "<button type='button' class='btn btn-outline btn-sm bg-pink-400 text-pink-800 btn-icon rounded-round legitRipple' title='Aplicar' data-nombre='$nombre' onclick='get_articulo(event)' data-toggle='modal' data-target='#'><i class='icon-square-down-right' data-nombre='$nombre' onclick='get_articulo(event)'></i></button>";
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
    function costo($costo){
        if(!empty($costo)){
            $moneda = number_format($costo, 2, ',', ' ');
            return "<h6 class='font-weight-semibold text-primary-800 mb-0'>$ $moneda</h6>";
        }else{
            return "";
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);