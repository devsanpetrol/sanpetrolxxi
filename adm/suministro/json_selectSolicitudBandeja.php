<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_solicitudes();
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha_solicitud']);
        $d = $date->format('d');
        $m = $date->format('M');
        $folio = $valor['folio'];
        $contar = pedido_count($folio);
        $star = "<a href='#'>#$folio</a>";
        
        $nombre_e = $valor['nombre']." ".$valor['apellidos'];
        
        $data[] = array("star" => $star,
                        "foto" => foto($contar,$valor['leido']),
                        "solicita" => $nombre_e,
                        "pedidos" => pedido($folio),
                        "fecha" => $m." ".$d,
                        "folio" => $folio,
                        "leido" => $valor['leido']
                        );
    }
    
    function pedido($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos($folio);
        $lista = array();
        foreach($pedidos as $valor){
                $cantidad = $valor['cantidad'];
                $unidad = $valor['unidad'];
                $destino = $valor['destino'];
                $articulo = $valor['articulo'];
                $justificacion = $valor['justificacion'];
                $status_pedido = $valor['status_pedido'];
                array_push($lista,t_icon_x($status_pedido)." <span class='table-inbox-subject'>($cantidad $unidad) $articulo &nbsp;-&nbsp;</span><span class='badge badge-flat border-grey text-grey-600'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span>");
            }
        $todos = implode("</br>", $lista);
        return $todos;
    }
    function pedido_count($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_count($folio);
        return $pedidos[0]['c'];
    }
    function foto($contar, $leido){
        if($leido == 0){
            return "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/userlogin.jpg' class='rounded-circle' width='32' height='32' alt=''><span class='badge badge-danger badge-pill badge-float'>$contar</span></a>";
        }else{
            return "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/userlogin.jpg' class='rounded-circle' width='32' height='32' alt=''></a>";
        }
        
    }
    function t_icon_x($st){
       $status = array(
            "<span class='badge badge-mark bg-info-400 border-info-400'></span>",//NO revisado
            "<span class='text-success font-size-sm' title='Aprobado'><i class='icon-checkmark3 font-size-sm mr-1'></i></span>",
            "<span class='text-danger font-size-sm' title='Cancelado'><i class='icon-cross2 font-size-sm mr-1'></i></span>",
            "<span class='text-warning font-size-sm' title='En revisión'><i class='icon-eye8 font-size-sm mr-1'></i></span>",
            "<span class='text-slate-800 font-size-sm' title='Enviado a compra'><i class='icon-cart font-size-sm mr-1'></i></span>",
            "<span class='text-pink font-size-sm' title='Listo entrega'><i class='icon-bell3 font-size-sm mr-1'></i></span>",
            "<span class='text-slate-800 font-size-sm' title='Entregado'><i class='icon-clipboard2 font-size-sm mr-1'></i></span>",
            "<span class='badge badge-mark bg-primary border-primary'></span>",//Comentario
            "<span class='badge badge-mark bg-danger-400 border-danger-400'></span>",
            "<span class='badge badge-mark bg-violet-400 border-violet-400'></span>",
            "<span class='badge badge-mark bg-indigo-800 border-indigo-800'></span>"
        );
        return $status[$st];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    