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
        $marca = $_POST['marca'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];
        $tiempo_utilidad = $_POST['tiempo_utilidad'];
        $fecha_baja = $_POST['fecha_baja'];
        $costo = $_POST['costo'];
        $no_inventario = $_POST['no_inventario'];
        $no_serie = $_POST['no_serie'];
        $status = $_POST['status'];
        $salida_rapida = $_POST['salida_rapida'];
        $disponible = $_POST['disponible'];
        $operable = $_POST['operable'];
        
        $guarda = $suministro->set_update_activo($cod_articulo, $id_articulo, $cod_barra, $descripcion, $especificacion, $marca, $fecha_adquisicion, $tiempo_utilidad, $fecha_baja,$costo, $no_inventario, $no_serie,$status,$disponible,$operable, $salida_rapida);
        
        if ($guarda === true){
            $data[] = array("result"=>'exito');
        }else{
            $data[] = array("result"=>'no guardo');
        }
    }else{
            $data[] = array("result"=>'sin dato');
    }
    header('Content-Type: application/json');
    echo json_encode($data);
