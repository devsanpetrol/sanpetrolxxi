<?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_destino_1($searchTerm);
    $datos = array(
        'key_wh' => $dato[0]['key_wh'],
        'tipo' => $dato[0]['tipo'],
        'destino' => $dato[0]['destino'],
        'id_reference' => $dato[0]['id_reference'],
        'tabla' => $dato[0]['tabla']
    );
}else{
    $datos = array(
        'key_wh' => '',
        'tipo' => '',
        'destino' => '',
        'id_reference' => '',
        'tabla' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);