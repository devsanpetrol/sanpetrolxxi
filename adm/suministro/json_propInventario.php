    <?php
require_once './suministro.php';
$suministro = new suministro();

$datos = array(
            'stock' => '',
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
            'id_activo' => '',
            'tiempo_utilidad' => '',
            'fecha_alta' => '',
            'fecha_baja' => '',
            'costo' => '',
            'no_inventario' => '',
            'no_serie' => '',
            'salida_rapida' => '',
            'disponible' => '',
            'operable' => '',
            'status' => ''
        );

if(!empty($_POST['cod_articulo'])){
    $dato = $suministro->get_propArticuloInv($_POST['cod_articulo']);
    if( count($dato) > 0 ){
        $datos = array(
            'cod_articulo' => $dato[0]['cod_articulo'], //OK
            'descripcion' => $dato[0]['descripcion'], //OK
            'especificacion' => $dato[0]['especificacion'], //OK
            'tipo_unidad' => $dato[0]['tipo_unidad'], //OK
            'marca' => $dato[0]['marca'], //OK
            'id_categoria' => $dato[0]['id_categoria_activo'], //OK
            'nombre_categoria' => $dato[0]['nombre_categoria'],
            'id_articulo' => $dato[0]['id_articulo'],
            'cod_barra' => $dato[0]['cod_barra'], //OK
            'importancia' => $dato[0]['importancia'],
            'id_activo' => $dato[0]['id_activo'],
            'tiempo_utilidad' =>  $dato[0]['tiempo_utilidad'],//OK
            'fecha_alta' =>  mydate($dato[0]['fecha_alta']),//OK
            'fecha_baja' =>  mydate($dato[0]['fecha_baja']),//OK
            'costo' =>  $dato[0]['costo'],//OK
            'no_inventario' =>  $dato[0]['no_inventario'],//OK
            'no_serie' =>  $dato[0]['no_serie'],//OK
            'salida_rapida' => $dato[0]['salida_rapida'],//OK
            'disponible' => $dato[0]['disponible'],//OK
            'operable' => $dato[0]['operable'],//OK
            'status' =>  $dato[0]['status']
        );
    }
}
function mydate($fecha){
    if($fecha == null){
        return null;
    }else{
        $date = date_create($fecha);
        return date_format($date, 'Y-m-d');
    }
}
header('Content-Type: application/json');
echo json_encode($datos, JSON_FORCE_OBJECT);