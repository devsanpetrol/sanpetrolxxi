<?php
    require_once './suministro.php'; 
    
    $id_factura = $_POST['id_factura'];
    $suministro = new suministro();
    $pedidos = $suministro->get_doctoFacturaDetail("WHERE id_factura = $id_factura");
    $data = array();
    
    foreach ($pedidos as $valor){
        $data[] = array("articulo" => articulo($valor["descripcion"], $valor["marca"]),
                        "cantidad" => unidad($valor["cantidad"]),
                        "unidad" => unidad($valor["tipo_unidad"]),
                        "precio_unidad" => cantidad($valor["precio_unidad"]),
                        "total" => cantidad($valor["total"])
                    );
    }
    function cantidad($cantidad){
        $cantidad = moneda($cantidad);
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800'>$ $cantidad</h6>";
    }
    function unidad($unidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800'>$unidad</h6>";
    }
    function articulo($articulo,$marca){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$articulo</h6><span class='d-block font-size-sm text-muted'>$marca</span>";
    }
    function destino($destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-700'>$destino</h6>";
    }
    function moneda ($valor){
        return $moneda = number_format($valor, 2, '.', ', ');
    }
    header('Content-Type: application/json');
    echo json_encode($data);