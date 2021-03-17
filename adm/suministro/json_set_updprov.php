 <?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
            
    if(!empty ($_POST['id_proveedor']) && !empty ($_POST['nombre'])){
        $id_proveedor = $_POST['id_proveedor'];
        $rfc = $_POST['rfc'];
        $nombre  = $_POST['nombre'];
        $razon_social  = $_POST['razon_social'];
        $direccion  = $_POST['direccion'];
        $num_telefono  = $_POST['num_telefono'];
        $email  = $_POST['email'];
        $pagina_web  = $_POST['pagina_web'];
        $actividad_comercial  = $_POST['actividad_comercial'];
        
        $result = $suministro->set_upd_proveedor($id_proveedor,$rfc,$nombre,$razon_social,$direccion,$num_telefono,$email,$pagina_web,$actividad_comercial);
        $data[] = array('result' => $result, 'type' => 'update');
        
    }else{
        $data[] = array('result' => "vacio", 'type' => 'update');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);