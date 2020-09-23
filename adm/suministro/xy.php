<?php
require_once './suministro.php';
$suministro = new suministro();
$detail   = $suministro -> get_detailAvailableFactura("EPP0037");

$data = array();

foreach ($detail as $valor){
    
    for($i=1; $i <= $valor["restante"]; $i++){
        echo $valor["descripcion"]." ".$valor["precio_unidad"]."</br>";
    }
}