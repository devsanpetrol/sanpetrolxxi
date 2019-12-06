<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_solicitud_aprobacion_detail();
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha_firma_encargado']);
        $d = $date->format('d');
        $m = $date->format('M');
        $folio = $valor['folio_vale'];
        $contar = pedido_count($folio);
        $star = "<a href='#'>#$folio</a>";
        $foto = "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/placeholder.jpg' class='rounded-circle' width='32' height='32' alt=''><span class='badge badge-danger badge-pill badge-float border-2 border-white'>$contar</span></a>";
        
        $data[] = array("star" => $star,
                        "pedidos" => pedido($folio),
                        "fecha" => $m." ".$d,
                        "folio" => $folio
                        );
    }
    
    function pedido($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_salida($folio);
        $lista = array();
        foreach($pedidos as $valor){
                $cantidad = $valor['cantidad_entregado'];
                $unidad = $valor['unidad'];
                $destino = $valor['destino'];
                $articulo = $valor['articulo'];
                $justificacion = $valor['justificacion'];
                array_push($lista," <span class='table-inbox-subject'>($cantidad $unidad) $articulo &nbsp;-&nbsp;</span><span class='badge badge-flat border-grey text-grey-600'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span>");
            }
        $todos = implode("</br>", $lista);
        return $todos;
    }
    function pedido_count($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_count($folio);
        return $pedidos[0]['c'];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    