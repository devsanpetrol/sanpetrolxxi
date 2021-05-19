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
        $data[] = array("descripcion" => nombre($valor['descripcion'],$valor['no_inventario'],$valor['no_serie']),
                        "cod_articulo" => $valor['cod_articulo'],
                        "accion" => accion2($valor['cod_articulo'],$valor['descripcion'],$valor['no_serie'],$valor['asignado'])
                        );
    }
    function accion2($nombre,$descripcion,$no_serie,$asignacion){
        if($asignacion == 0){
            return "<i class='icon-square-down-right text-primary-800' style='cursor: pointer' title='Aplicar' data-nombre='$nombre' data-noserie='$no_serie' data-descripcion='$descripcion' onclick='get_articulo(event)'></i>&nbsp;&nbsp;&nbsp;&nbsp;";
        }else{
            return "<span class='badge badge-danger' title='Privado. (El material ya esta asignado a un empleado activo)' >P</span>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
    }
    function nombre($nombre,$ac,$ns){
        $act = trim($ac);
        $sn = trim($ns);
        if(!empty($act) && !empty($sn)){
            return "$nombre
                    <div class='text-grey-300 font-size-sm font-weight-semibold'>$act&nbsp;&nbsp;&nbsp;SN: $sn</div>";
        }else if(!empty($act)){
            return "$nombre
                    <div class='text-grey-300 font-size-sm font-weight-semibold'>$act</div>";
        } else{
            return $nombre;
        }
    }
    function rfc($rfc){
        return "$rfc";
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