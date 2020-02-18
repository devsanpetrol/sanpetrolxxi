<?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_busqueda_1($searchTerm);
    $datos = array(
        'cod_articulo'   => $dato[0]['cod_articulo'],
        'descripcion'    => $dato[0]['descripcion'],
        'tipo_unidad'    => $dato[0]['tipo_unidad']
    );
}else{
    $datos = array(
        'cod_articulo' => '',
        'descripcion' => '',
        'tipo_unidad' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);