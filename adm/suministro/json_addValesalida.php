<?php
require_once './suministro.php';
$suministro = new suministro();

$folio_valesalida = $_POST["folio"];

$id_articulo = $suministro -> set_new_valesalida($folio_valesalida);

if( $id_articulo > 0 ){
    $datos = array(
        'result' => $id_articulo
    );
}else{
    $datos = array(
        'result' => "none"
    );
}

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);