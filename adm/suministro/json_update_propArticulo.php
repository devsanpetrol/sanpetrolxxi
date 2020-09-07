<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    //$cod_articulo,$id_articulo, $cod_barra,$descripcion,$especificacion,$tipo_unidad,$marca,$id_categoria,$stock_min,$stock_max,$importancia,$ubicacion;
    if(!empty($_POST['cod_articulo']) && !empty($_POST['id_articulo'])){
        $id_articulo = $_POST['id_articulo'];
        $cod_articulo = $_POST['cod_articulo'];
        $cod_barra = $_POST['cod_barra'];
        $descripcion = $_POST['descripcion'];
        $especificacion = $_POST['especificacion'];
        $tipo_unidad = $_POST['tipo_unidad'];
        $marca = $_POST['marca'];
        $id_categoria = $_POST['id_categoria'];
        $stock_min = $_POST['stock_min'];
        $stock_max = $_POST['stock_max'];
        $ubicacion = $_POST['ubicacion'];
        $salida_rapida = $_POST['salida_rapida'];
        
        $guarda = $suministro->set_update_articulo($cod_articulo, $id_articulo, $cod_barra, $descripcion, $especificacion, $tipo_unidad, $marca, $id_categoria, $stock_min, $stock_max, $ubicacion,$salida_rapida);
        
        if ($guarda == true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);