<?php
    require_once './suministro.php'; 
    
    $data = array();
    
    if(!empty($_POST['fecha_solicitud']) && !empty($_POST['id_formato']) && !empty($_POST['clave_solicita'])){
        $fecha_solicitud  = $_POST['fecha_solicitud'];
        $status_solicitud = $_POST['status_solicitud'];
        $id_formato       = $_POST['id_formato'];
        $clave_solicita   = $_POST['clave_solicita'];
        $suministro = new suministro();
        $articulos  = $suministro->set_solicitud($fecha_solicitud, $status_solicitud, $id_formato, $clave_solicita);
        foreach ($articulos as $valor) {
            $data[] = array("folio"=>$valor['folio']);
        }
    }else{
        $data[] = array("folio"=>'falla');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);