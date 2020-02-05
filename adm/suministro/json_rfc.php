    <?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_busqueda_rfc($searchTerm);
    if( count($dato) > 0 ){
        $datos = array(
            'rfc' => $dato[0]['rfc'],
            'nombre' => $dato[0]['nombre'],
            'direccion' => $dato[0]['direccion'],
            'codigopostal' => $dato[0]['codigo_postal'],
            'telefono' => $dato[0]['num_telefono'],
            'correo' => $dato[0]['email']
        );
    }else{
        $datos = array(
            'rfc' => '',
            'nombre' => '',
            'direccion' => '',
            'codigopostal' => '',
            'telefono' => '',
            'correo' => ''
        );
    }
}else{
    $datos = array(
        'rfc' => '',
        'nombre' => '',
        'direccion' => '',
        'codigopostal' => '',
        'telefono' => '',
        'correo' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);