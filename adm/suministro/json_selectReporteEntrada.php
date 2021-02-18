<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $categorias = $suministro->get_almacen_reporte_entrada($fecha_inicio,$fecha_fin);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cod_articulo" => $valor['cod_articulo'],//ok
                        "descripcion" => $valor['descripcion'],//ok
                        "marca" => $valor['marca'],//ok
                        "cantidad" => $valor['cantidad'],//ok
                        "tipo_unidad" => $valor['tipo_unidad'],//ok
                        "precio_unidad" => $valor['precio_unidad'],//ok
                        "subtotal" => $valor['sub_total'],//ok
                        "id_factura" => $valor['id_factura'],//ok
                        "fecha_emision" => $valor['fecha_emision'],//ok
                        "nombre" => $valor['nombre'],//ok
                        "fecha_emision" => $valor['fecha_emision'],//ok
                        "proveedor" => proveedor($valor['fecha_emision'],$valor['id_factura'],$valor['nombre'],$valor['serie_folio'],$valor['total'])//ok
                        );        
    }
    function proveedor($fecha,$factura,$proveedor,$serie_folio,$total){
        return "<h6 class='text-primary-800 mb-0'>$fecha Folio: $factura, $proveedor Serie-Folio: $serie_folio, Total: $total</h6>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);