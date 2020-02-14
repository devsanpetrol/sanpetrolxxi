<?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_destino_1($searchTerm);
    $datos = array(
        'resp' => $dato[0]['id_responsable_area'],
        'dest' => $dato[0]['area_depto_equipo'],
        'id_emp' => $dato[0]['id_empleado']
    );
}else{
    $datos = array(
        'resp' => '',
        'dest' => '',
        'id_emp' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);