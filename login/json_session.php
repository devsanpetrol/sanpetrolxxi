<?php

    include_once './log.php';
    $log = new log();
    
    $user = $_POST['user'];
    $pass = $_POST['password'];
    
    $chk_session = $log->get_access_login($user, $pass);
    
    if(count($chk_session)== 1){
        $datos = array(
            'estatus' => 'aceptado',
            '' => 'aceptado'
        );
    }else{
        $datos = array(
            'estatus' => 'declinado'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($datos, JSON_FORCE_OBJECT);