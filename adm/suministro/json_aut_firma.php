<?php
    require_once './suministro.php';
    $suministro = new suministro();

    $usuario  = $_POST['usuario'];
    $password = $_POST['password'];
    $tokenid  = $_POST['tokenid'];

    $resultado = $suministro->autentificar_firma($usuario, $password, $tokenid);

    if($resultado == "error_acount"){
        $datos = array(
            'result' => "error_acount",
        );
    }elseif($resultado == "acount_denied"){
        $datos = array(
            'result' => "acount_denied",
        );
    }else{
        $datos = $resultado[0];
    }
    header('Content-Type: application/json');
    echo json_encode($datos, JSON_FORCE_OBJECT);//($datos, JSON_FORCE_OBJECT);