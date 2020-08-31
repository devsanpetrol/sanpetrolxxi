 <?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_factura = $_POST["id_factura"];
    $factura = $suministro->get_doctoFactura("WHERE id_factura = $id_factura");
    $data = array();
    
    $data[] = array("serie_folio" => ucwords(mb_strtolower($factura[0]['serie_folio'])),
                    "fecha_emision" => $factura[0]['fecha_emision'],
                    "lugar_emision" => $factura[0]['lugar_emision'],
                    "uuid" => ucwords(mb_strtolower($factura[0]['uuid'])),
                    "total" => "$ " . moneda($factura[0]['total']),
                    "date_insert" => $factura[0]['date_insert'],
                    // DATOS DE PROVEEDOR
                    "rfc" => ucwords(mb_strtolower($factura[0]['rfc'])),
                    "nombre" => $factura[0]['nombre'],
                    "email" => strtolower($factura[0]['email']),
                    "pagina_web" => $factura[0]['pagina_web'],
                    "num_telefono" => $factura[0]['num_telefono'],
                    "direccion" => $factura[0]['direccion']
                    );
    
    function moneda ($valor){
        return $moneda = number_format($valor, 2, '.', ', ');
    }
    function fecha($fecha){
        $date = new DateTime($fecha);
        return $date->format('F d (ga)');
    }
    header('Content-Type: application/json');
    echo json_encode($data);