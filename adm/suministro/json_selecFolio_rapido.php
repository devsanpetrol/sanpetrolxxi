<?php
    require_once './suministro.php'; 
    
    $data = array();
    
    if(!empty($_POST['fecha_solicitud']) && !empty($_POST['clave_solicita'])){
        $fecha_solicitud  = $_POST['fecha_solicitud'];
        $clave_solicita   = $_POST['clave_solicita'];
        $nombre_solicita  = $_POST['nombre_solicita'];
        $puesto_solicita  = $_POST['puesto_solicita'];
        $sitio_operacion  = $_POST['sitio_operacion'];
        $id_equipo        = $_POST['id_equipo'];
        $id_solicita        = $_POST['id_solicita'];
        
        $suministro = new suministro();
        $articulos  = $suministro->set_solicitud_rapido($fecha_solicitud,$clave_solicita,$nombre_solicita,$puesto_solicita,$sitio_operacion,$id_equipo,$id_solicita);
        foreach ($articulos as $valor) {
            $data[] = array("folio"=>$valor['folio']);
        }
    }else{
        $data[] = array("folio"=>'falla');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);