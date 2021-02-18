<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $id_asignacion = $_POST["id_asignacion"];
    $categorias = $catalogo->get_asignacion_("WHERE id_asignacion = $id_asignacion");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("nombre" => $valor['nombre'],
                        "apellidos" => $valor['apellidos'],
                        "id_empleado" => $valor['id_empleado'],
                        "cargo" => $valor['cargo'],
                        "no_inventario" => $valor['no_inventario'],
                        "no_serie" => $valor['no_serie'],
                        "nombre_categoria" => $valor['nombre_categoria'],
                        "cod_articulo" => $valor['cod_articulo'],
                        "descripcion" => $valor['descripcion'],
                        "fecha_recibe" => $valor['fecha_recibe'],
                        "especificacion_tec" => $valor['especificacion_tec']
                        );
        
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);