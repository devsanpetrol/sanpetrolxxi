<?php
require_once './suministro.php';
$suministro = new suministro();

$folio_valesalida = $_POST["folio"];
$recibe = $_POST["recibe"];
$id_articulo = $suministro -> set_new_valesalida_rapido($folio_valesalida,$recibe);

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