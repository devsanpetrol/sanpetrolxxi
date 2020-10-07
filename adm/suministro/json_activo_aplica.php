<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    if(empty($_POST["filter"])){
        $categorias = $suministro->get_activofijo_detail();
    }else{
        $categorias = $suministro->get_activofijo_detail($_POST["filter"]);
    }
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("descripcion" => nombre($valor['descripcion'],$valor['no_serie']),
                        "cod_articulo" => rfc($valor['cod_articulo']),
                        "especificacion" => rfc($valor['especificacion_tec']),
                        "accion" => accion2($valor['cod_articulo'],$valor['descripcion'],$valor['no_serie'],$valor['asignado'])
                        );
    }
    function accion2($nombre,$descripcion,$no_serie,$asignacion){
        if($asignacion == 0){
            return "<i class='icon-square-down-right text-primary-800' style='cursor: pointer' title='Aplicar' data-nombre='$nombre' data-noserie='$no_serie' data-descripcion='$descripcion' onclick='get_articulo(event)'></i>";
        }else{
            return "<span class='badge badge-danger' title='Privado. (El material ya esta asignado a un empleado activo)' >P</span>";
        }
    }
    function nombre($nombre,$ac){
        $act = trim($ac);
        if(!empty($act)){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre</h6>
                    <div class='text-grey-300 font-size-sm font-weight-semibold'>SN: <span class='text-danger-800 font-size-sm font-weight-semibold'>$act</span></div>";
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