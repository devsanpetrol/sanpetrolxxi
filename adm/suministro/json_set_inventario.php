 <?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $cod_articulo      = $_POST['cod_articulo'];
    $cod_articulo_new  = $_POST['cod_articulo_new'];
    $inventariado      = $_POST['inventariado'];
    $id_factura_detalle        = $_POST['id_factura_detalle'];
    $id_factura        = $_POST['id_factura'];
    $id_categoria        = $_POST['id_categoria'];
    
    $no_inventario = mb_strtoupper ($_POST['no_inventario']);
    $no_serie      = mb_strtoupper ($_POST['no_serie']);
    $especica      = $_POST['especificacion'];
    $costo         = $_POST['costo'];
    
    $exist         = $suministro -> set_select_cout_inventario($no_inventario);//set_select_cout_sku
    $exist_sku     = $suministro -> set_select_cout_sku($cod_articulo_new);//set_select_cout_sku

    if($exist_sku){
        if(!empty($_POST['no_inventario'])){
            $result  = $suministro->set_update_new_articulo($cod_articulo_new,$no_inventario,$no_serie,$costo,$especica);
            $data[] = array("result" => $result, 'type' => 'update','inventariado' => 'si');
        }else{
            $result  = $suministro->set_delete_new_articulo($cod_articulo,$cod_articulo_new,$id_factura_detalle);
            $data[] = array('result' => $result, 'type' => 'delete','inventariado' => 'no');
        }
    }else{
        $result = $suministro->set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie,$costo,$especica,$id_factura_detalle,$id_factura,$id_categoria);
        $data[] = array('result' => $result, 'type' => 'insert','inventariado' => 'si');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);