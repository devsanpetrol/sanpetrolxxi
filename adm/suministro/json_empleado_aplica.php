<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $empleado = $suministro->get_empleado_detail("WHERE status = 1");
    $data = array();
    
    foreach ($empleado as $val) {
        $data[] = array("nombre" => nombre($val['nombre'],$val['apellidos']),
                        "puesto" => rfc($val['puesto']),
                        "accion" => accion2($val['nombre']." ".$val['apellidos'],$val['puesto'],$val['id_empleado'])
                        );
    }
    function accion2($nombre,$puesto,$id_empleado){
        return "<button type='button' class='btn btn-outline btn-sm bg-pink-400 text-pink-800 btn-icon rounded-round legitRipple' title='Aplicar' data-nombre='$nombre' data-puesto='$puesto' data-idempleado='$id_empleado' onclick='get_articulo(event)'>
                    <i class='icon-square-down-right' data-nombre='$nombre' data-puesto='$puesto' data-idempleado='$id_empleado' onclick='get_articulo(event)'></i>
                </button>";
    }
    function nombre($nombre,$apellidos){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre $apellidos</h6>";
    }
    function rfc($rfc){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$rfc</h6>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);