    <?php
require_once './suministro.php';
$suministro = new suministro();
$searchTerm = $_POST['searchTerm'];

if(!empty($_POST['searchTerm'])){
    $dato = $suministro->get_almacen_busqueda_codigosearch($searchTerm);
    if( count($dato) > 0 ){
        $datos = array(
            'cod_barra' => $dato[0]['cod_barra'],
            'cod_articulo' => $dato[0]['cod_articulo'],
            'descripcion' => $dato[0]['descripcion'],
            'unidad' => $dato[0]['tipo_unidad'],
            'config' => $dato[0]['config'],
            'salida_rapida' => $dato[0]['salida_rapida']
        );
    }else{
        $datos = array(
            'cod_barra' => '',
            'cod_articulo' => '',
            'descripcion' => '',
            'unidad' => '',
            'config' => '',
            'salida_rapida' => ''
        );
    }
}else{
    $datos = array(
        'cod_barra' => '',
        'cod_articulo' => '',
        'descripcion' => '',
        'unidad' => '',
        'config' => '',
        'salida_rapida' => ''
    );
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);