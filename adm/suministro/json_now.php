<?php
require_once './suministro.php';
$suministro = new suministro();

$dato = $suministro->get_now();

$datos = array(
    'fecha_actual' => $dato[0]['fecha_actual'],
    'fecha_corta'  => substr($dato[0]['fecha_actual'],0,10)
);

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);