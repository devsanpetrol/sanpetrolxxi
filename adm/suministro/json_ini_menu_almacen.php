<?php
require_once './suministro.php';
$suministro = new suministro();

$dato = $suministro->get_notify_almacen();

$datos = array(
    'almacen_salida' => $dato[0]['GENERA_SURTIDO'],
    'almacen_salida_aprobada' => $dato[0]['SURTIDO_SI_REVISADO'],
    'almacen_salida_compra' => $dato[0]['COMPRA_GENERA_LISTA'],
    'aprobacion_salida_compra_alm' => $dato[0]['STATUS_APROBACION'],
    'almacen_pendiente_surtido' => $dato[0]['PENDIENTE_SURTIDO']
);

header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);