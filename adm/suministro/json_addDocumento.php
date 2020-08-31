<?php
require_once './suministro.php';
$suministro = new suministro();

$serie_folio = strtoupper($_POST["serie_folio"]);
$fecha_emision = $_POST["fecha_emision"];
$lugar_emision = $_POST["lugar_emision"];
$uuid = strtoupper($_POST["uuid"]);
$total = str_replace("$ ","",$_POST["total"]);
$id_proveedor = $_POST["id_proveedor"];

$cadena = $fecha_emision;
$timestamp = strtotime($cadena);
$fecha =  date('Y-m-d', $timestamp);

$id_docto = $suministro -> set_add_documento($serie_folio, $fecha, $lugar_emision, $uuid, $total, $id_proveedor);

if( $id_docto > 0 ){
    $datos = array(
        'result' => $id_docto, 'stat' => 'ok', 'dat'=> $total
    );
}else{
    $datos = array(
        'result' => $id_docto,'stat' => 'fail', 'dat'=> $total
    );
}

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);