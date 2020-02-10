<?php
require_once './suministro.php';
$suministro = new suministro();

$cod_barra      = $_POST["cod_barra"];
$cod_articulo   = $_POST["cod_articulo"];
$descripcion    = $_POST["descripcion"];
$especificacion = $_POST["especificacion"];
$tipo_unidad    = $_POST["tipo_unidad"];
$marca          = $_POST["marca"];
$id_categoria   = $_POST["id_categoria"];

$id_articulo = $suministro -> set_new_articulo($cod_barra, $descripcion,$especificacion,$tipo_unidad,$marca,$id_categoria);

if( $id_articulo > 0 ){
    $datos = array(
        'result' => $suministro -> set_new_articulo_almacen($cod_articulo,$id_articulo)
    );
}else{
    $datos = array(
        'result' => $id_articulo
    );
}

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);