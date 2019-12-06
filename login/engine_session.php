<?php
session_start();
include_once './log.php';
$log = new log();

$user = $_POST['user'];
$pass = $_POST['password'];

$chk_session = $log->get_access_login($user, $pass);

if(count($chk_session)== 1){
    $_SESSION['id_usuario'] = $chk_session[0]['id_usuario'];
    $_SESSION['usuario'] = $chk_session[0]['usuario'];
    $_SESSION['estado'] = $chk_session[0]['estado'];
    $_SESSION['avatar'] = $chk_session[0]['avatar'];
    $_SESSION['tipo'] = $chk_session[0]['tipo'];
    $_SESSION['cargo'] = $chk_session[0]['cargo'];
    $_SESSION['email'] = $chk_session[0]['email'];
    $_SESSION['especialista'] = $chk_session[0]['especialista'];
    $_SESSION['telefono'] = $chk_session[0]['telefono'];
    $_SESSION['departamento'] = $chk_session[0]['departamento'];
    $_SESSION['nombre'] = $chk_session[0]['nombre'];
    $_SESSION['apellidos'] = $chk_session[0]['apellidos'];
    $_SESSION['id_empleado'] = $chk_session[0]['id_empleado'];
    $_SESSION['full_name'] = $chk_session[0]['nombre']." ".$chk_session[0]['apellidos'];
}
header('location:../index.php');