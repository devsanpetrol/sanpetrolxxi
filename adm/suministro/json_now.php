<?php
require_once './suministro.php';
$suministro = new suministro();

$dato = $suministro->get_now();

$datos = array(
    'fecha_actual' => $dato[0]['fecha_actual'],
);

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);