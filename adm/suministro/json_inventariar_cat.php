<?php
    require_once './suministro.php'; 
    
    $id_categoria = $_POST['id_categoria'];
    $suministro = new suministro();
    $sql = $suministro->get_categoria_resume_name($id_categoria);
    
    if( count($sql) > 0 ){
        $resume_name = $suministro->get_categoria_resume_name($id_categoria)[0]["resume_name"];
        $last_cod = $suministro->get_last_codarticulo($resume_name)[0]["cod_articulo"];
        
        $serial = get_numbercod($last_cod)+1;
        $numer_cod_articulo = get_newcodarticulo($resume_name,$serial);
        $data = array("cod_articulo" => $numer_cod_articulo);
    }else{
        $data = array("cod_articulo" => $resume_name."0001");
    }
    
    function get_newcodarticulo($category,$serial_numer){//ingresa un numero y concatena con categoria
        return $category.str_pad($serial_numer, 4, "0", STR_PAD_LEFT);
    }
    function get_numbercod($cod_articulo){ //obtiene el numero de la cadena
        return (int)substr($cod_articulo, -4);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);