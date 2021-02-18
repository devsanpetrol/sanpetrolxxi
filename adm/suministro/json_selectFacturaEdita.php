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
                        "proveedor" => proveedor(accion($valor['id_factura']),$valor['id_factura'],$valor['nombre'])//ok
                        );        
    }
    function proveedor($editar,$factura,$proveedor){
        return "<h6 class='text-primary-800 mb-0'># $factura - $proveedor  $editar</h6>";
    }
    function accion($id_factura){
        
    return "<div class='list-icons list-icons-extended'>
                <a href='#' class='list-icons-item'><i class='icon-pencil3' data-idfactura='$id_factura' onclick='openModalFacturaDetail(event)'></i></a>
                <div class='list-icons-item dropdown d-none'>
                    <a href='#' class='list-icons-item dropdown-toggle' data-toggle='dropdown'><i class='icon-file-text2'></i></a>
                    <div class='dropdown-menu dropdown-menu-right'>
                        <a href='#' class='dropdown-item'><i class='icon-file-download'></i> Download</a>
                        <a href='#' class='dropdown-item'><i class='icon-printer'></i> Print</a>
                        <div class='dropdown-divider'></div>
                        <a href='#' class='dropdown-item'><i class='icon-file-plus'></i> Edit</a>
                        <a href='#' class='dropdown-item'><i class='icon-cross2'></i> Remove</a>
                    </div>
                </div>
            </div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);