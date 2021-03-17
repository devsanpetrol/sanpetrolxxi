    <?php
require_once './suministro.php';
$suministro = new suministro();

$datos = array(
            'id_proveedor' => '',
            'rfc' => '',
            'nombre' => '',
            'razon_social' => '',
            'direccion' => '',
            'codigo_postal' => '',
            'edo_prov' => '',
            'num_telefono' => '',
            'email' => '',
            'detalle_contacto' => '',
            'pagina_web' => '',
            'monto_credito' => '',
            'dias_credito' => '',
            'actividad_comercial' => ''
        );

if(!empty($_POST['id_proveedor'])){
    $id_proveedor = $_POST['id_proveedor'];
    $dato = $suministro->get_proveedor("WHERE id_proveedor = $id_proveedor LIMIT 1");
    if( count($dato) > 0 ){
        $datos = array(
            'id_proveedor' => $dato[0]['id_proveedor'],
            'rfc' => $dato[0]['rfc'],
            'nombre' => $dato[0]['nombre'],
            'razon_social' => $dato[0]['razon_social'],
            'direccion' => $dato[0]['direccion'],
            'codigo_postal' => $dato[0]['codigo_postal'],
            'edo_prov' => $dato[0]['edo_prov'],
            'num_telefono' => $dato[0]['num_telefono'],
            'email' => $dato[0]['email'],
            'detalle_contacto' => $dato[0]['detalle_contacto'],
            'pagina_web' => $dato[0]['pagina_web'],
            'monto_credito' => $dato[0]['monto_credito'],
            'dias_credito' => $dato[0]['dias_credito'],
            'actividad_comercial' => $dato[0]['actividad_comercial']
        );
    }
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);