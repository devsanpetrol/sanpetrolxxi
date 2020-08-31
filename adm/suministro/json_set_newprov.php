 <?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
            
    if(!empty ($_POST['nombre'])){
        $rfc = $_POST['rfc'];
        $nombre  = $_POST['nombre'];
        $direccion  = $_POST['direccion'];
        $num_telefono  = $_POST['num_telefono'];
        $email  = $_POST['email'];
        $pagina_web  = $_POST['pagina_web'];
        $actividad_comercial  = $_POST['actividad_comercial'];
        
        $result = $suministro->set_new_proveedor($rfc,$nombre,$direccion,$num_telefono,$email,$pagina_web,$actividad_comercial);
        $data[] = array('result' => $result, 'type' => 'insert');
        
    }else{
        $data[] = array('result' => "vacio", 'type' => 'insert');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);