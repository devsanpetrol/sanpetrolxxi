<?php
    require_once './suministro.php'; 
    $suministro = new suministro();
    $data = array();
    
    if(!empty($_POST['cod_articulo'])){
        $cod_articulo = $_POST['cod_articulo'];
        $cod_barra = $_POST['cod_barra'];
        $descripcion = mb_strtoupper($_POST['descripcion']);
        $especificacion = $_POST['especificacion'];
        $tipo_unidad = $_POST['tipo_unidad'];
        $marca = mb_strtoupper($_POST['marca']);
        $id_categoria = $_POST['id_categoria'];
        $fecha_alta = $_POST['fecha_adquisicion'];
        $tiempo_utilidad = $_POST['tiempo_utilidad'];
        $costo = $_POST['costo'];
        $no_inventario = mb_strtoupper($_POST['no_inventario']);
        $no_serie = mb_strtoupper($_POST['no_serie']);
        $status = $_POST['status'];
        $salida_rapida = $_POST['salida_rapida'];
        $disponible = $_POST['disponible'];
        $operable = $_POST['operable'];
        
        $id_articulo = $suministro ->set_insert_articulo($cod_barra, $descripcion, $especificacion, $tipo_unidad, $marca, $id_categoria);
        if($id_articulo == TRUE){
            $insert_almacen = $suministro -> set_insert_almacen($cod_articulo,$id_articulo,$salida_rapida);
            if($insert_almacen == TRUE){
                $insert_activo = $suministro ->set_insert_activo($tiempo_utilidad, $fecha_alta, $costo, $no_inventario, $no_serie, $status, $operable, $disponible, $cod_articulo,$id_categoria);
            }
        }
                
        if ($insert_activo == TRUE){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);