    <?php
require_once './suministro.php';
$suministro = new suministro();

$datos = array(
            'stock' => '',
            'stock_min' => '',
            'stock_max' => '',
            'importancia' => '',
            'ubicacion' => '',
            'descripcion' => '',
            'especificacion' => '',
            'tipo_unidad' => '',
            'marca' => '',
            'id_categoria' => '',
            'nombre_categoria' => '',
            'id_articulo' => '',
            'cod_barra' => '',
            'salida_rapida' => ''
        );

if(!empty($_POST['cod_articulo'])){
    $dato = $suministro->get_propArticulo($_POST['cod_articulo']);
    if( count($dato) > 0 ){
        $datos = array(
            'cod_articulo' => $dato[0]['cod_articulo'], //OK
            'descripcion' => $dato[0]['descripcion'], //OK
            'especificacion' => $dato[0]['especificacion'], //OK
            'tipo_unidad' => $dato[0]['tipo_unidad'], //OK
            'marca' => $dato[0]['marca'], //OK
            'id_categoria' => $dato[0]['id_categoria'], //OK
            'nombre_categoria' => $dato[0]['nombre_categoria'],
            'id_articulo' => $dato[0]['id_articulo'],
            'cod_barra' => $dato[0]['cod_barra'], //OK
            'stock' => $dato[0]['stock'],
            'stock_min' => $dato[0]['stock_min'],
            'stock_max' => $dato[0]['stock_max'],
            'importancia' => $dato[0]['importancia'],
            'ubicacion' => $dato[0]['ubicacion'],
            'salida_rapida' => $dato[0]['salida_rapida']
        );
    }
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);