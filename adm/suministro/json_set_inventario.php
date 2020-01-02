 <?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    $cod_articulo      = $_POST['cod_articulo'];
    $cod_articulo_new  = $_POST['cod_articulo_new'];
    $inventariado      = $_POST['inventariado'];
    
    if($inventariado == "no" && !empty ($_POST['no_inventario'])){
        $no_inventario = $_POST['no_inventario'];
        $no_serie      = $_POST['no_serie'];
        $costo         = $_POST['costo'];
        $result = $suministro->set_insert_new_articulo($cod_articulo,$cod_articulo_new,$no_inventario,$no_serie,$costo);
        $data[] = array("result" => $result,"type"=>"insert");
    }else if($inventariado == "si" && !empty ($_POST['no_inventario'])){
        $no_inventario = $_POST['no_inventario'];
        $no_serie      = $_POST['no_serie'];
        $costo         = $_POST['costo'];
        $result  = $suministro->set_update_new_articulo($cod_articulo_new,$no_inventario,$no_serie,$costo);
        $data[] = array("result" => $result,"type"=>"update");
    }else if($inventariado == "si" && empty ($_POST['no_inventario'])){
        $result  = $suministro->set_delete_new_articulo($cod_articulo,$cod_articulo_new);
        $data[] = array("result" => $result,"type"=>"delete");
    }
    
    
    header('Content-Type: application/json');
    echo json_encode($data);