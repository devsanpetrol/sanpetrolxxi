<?php
require_once './suministro.php';
$suministro = new suministro();

$cantidad = $_POST["cantidad"];
$precio_unidad = $_POST["precio_unidad"];
$total = $_POST["total"];
$id_factura = $_POST["id_factura"];
$cod_articulo = $_POST["cod_articulo"];

$id_articulo = $suministro -> set_add_articulo($cantidad, $precio_unidad, $total, $id_factura, $cod_articulo);

if( $id_articulo > 0 ){
    $datos = array(
        'result' => $id_articulo, 'stat'=>'ok'
    );
}else{
    $datos = array(
        'result' => $id_articulo, 'stat'=>'fail'
    );
}

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);