<?php
require_once './suministro.php';
$suministro = new suministro();

if(!empty($_POST['id_compra_lista'])){
    $id_compra_lista = $_POST['id_compra_lista'];
    $dato = $suministro->get_solicitud_aprobacion_compra_datos_firma($id_compra_lista);
    $datos = array(
        'id_compra_lista' => $dato[0]['id_compra_lista'],
        
        'encargado_almacen' => $dato[0]['encargado_almacen'],
        'fecha_inicial' => $dato[0]['fecha_inicial'],
        'visto_bueno' => $dato[0]['visto_bueno'],
        'fecha_revision' => $dato[0]['fecha_revision'],
        
        'nombre_encargado' => $dato[0]['nombre_encargado'],
        'apellido_encargado' => $dato[0]['apellido_encargado'],
        'nombre_supervision' => $dato[0]['nombre_supervision'],
        'apellido_supervision' => $dato[0]['apellido_supervision'],
        
        'aprobado' => $dato[0]['aprobado']
    );
}else{
    $datos = array(
        'id_compra_lista' => "",
        'encargado_almacen' => "",
        'fecha_inicial' => "",
        'visto_bueno' => "",
        'fecha_revision' => "",
        'nombre_encargado' => "",
        'apellido_encargado' => "",
        'nombre_supervision' => "",
        'apellido_supervision' => "",
        'aprobado' => ""
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);