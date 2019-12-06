<?php
session_start();

if(empty($_SESSION['id_usuario'])){
   header("location:../inicio/login.php");
}
$hora = date("m");
if($hora <= 11){
    $_SESSION['dia_tiempo'] = $hora;
}else if($hora <= 18 ){
    $_SESSION['dia_tiempo'] = $hora;
}else{
    $_SESSION['dia_tiempo'] = $hora;
}