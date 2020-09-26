<?php
    require_once './suministro.php';
    $suministro = new suministro();
    $categoria    = 'MOBI';//$_POST['categoria'];
    $detail   = $suministro -> get_detailAvailableFactura("EPP0037");
    $last_cod = $suministro -> get_last_codarticulo($categoria);
    
    $data = array();
    $count = 1;
    
    if(!empty($last_cod)){
        $last_cod = $last_cod[0]["cod_articulo"];
    }else{
        $last_cod = $categoria."0000";
    }
    
    foreach ($detail as $valor){
        for($i=1; $i <= $valor["restante"]; $i++){
            $serial = get_numbercod($last_cod)+$count++;
            $numer_cod_articulo = get_newcodarticulo($categoria,$serial);
            $data[] = array("cod_articulo" => $numer_cod_articulo);
        }
    }
    
    function get_newcodarticulo($category,$serial_numer){//ingresa un numero y concatena con categoria
        return $category.str_pad($serial_numer, 4, "0", STR_PAD_LEFT);
    }
    function get_numbercod($cod_articulo){ //obtiene el numero de la cadena
        return (int)substr($cod_articulo, -4);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);