<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $empleado = $suministro->get_empleado_detail("WHERE status = 1 ORDER BY nombre ASC");
    $data = array();
    
    foreach ($empleado as $val) {
        $data[] = array("nombre" => nombre($val['nombre'],$val['apellidos']),
                        "puesto" => $val['puesto'],
                        "accion" => accion2($val['nombre']." ".$val['apellidos'],$val['puesto'],$val['id_empleado'])
                        );
    }
    function accion2($nombre,$puesto,$id_empleado){
        return "<i class='icon-square-down-right text-primary-800' style='cursor: pointer' title='Aplicar' data-nombre='$nombre' data-puesto='$puesto' data-idempleado='$id_empleado' onclick='get_empleado(event)'></i>";
    }
    function nombre($nombre,$apellidos){
        return $nombre." ".$apellidos;
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);