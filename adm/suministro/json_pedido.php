<?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_busqueda_1($searchTerm);
    $datos = array(
        'cod_articulo'   => $dato[0]['cod_articulo'],
        'descripcion'    => $dato[0]['descripcion'],
        'especificacion' => $dato[0]['especificacion'],
        'id_categoria'   => $dato[0]['id_categoria'],
        'stock'          => $dato[0]['stock'],
        'no_inventario'  => $dato[0]['no_inventario'],
        'tipo_unidad'    => $dato[0]['tipo_unidad']
    );
}else{
    $datos = array(
        'cod_articulo' => '',
        'descripcion' => '',
        'especificacion' => '',
        'especificacion' => '',
        'id_categoria'   => '',
        'stock'          => '',
        'tipo_unidad' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);