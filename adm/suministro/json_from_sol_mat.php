<?php
require_once './suministro.php';
$suministro = new suministro();
$numformat = $_POST['numformat'];

$dato = $suministro->get_form_sol_mat($numformat);

header('Content-Type: application/json');

$datos = array(
    'num_formato' => $dato[0]['num_formato'],
    'num_revision' => $dato[0]['num_revision'],
    'fecha_rev' => $dato[0]['fecha_rev'],
    'funcion' => $dato[0]['funcion'],
    'region' => $dato[0]['region'],
    'revisado' => $dato[0]['revisado'],
    'autorizado' => $dato[0]['autorizado']
);

echo json_encode($datos, JSON_FORCE_OBJECT);