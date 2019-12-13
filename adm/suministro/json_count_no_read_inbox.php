<?php
require_once './suministro.php';
$suministro = new suministro();

$dato = $suministro->noread_inbox();

$datos = array(
    'noread' => $dato[0]['total']
);

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);