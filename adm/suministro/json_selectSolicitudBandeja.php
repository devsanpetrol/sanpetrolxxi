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
                array_push($lista,"<li>".t_icon_x($status_pedido)." <span class='table-inbox-subject'>($cantidad $unidad) $articulo &nbsp;-&nbsp;</span><span class='badge badge-flat border-grey text-grey-600'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span></li>");
            }
        $todos = implode("", $lista);
        return "<ul class='list-unstyled mb-0'>".$todos."</ul>";
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
            "<i class='mi-done font-size-xl font-weight-bold text-slate-300 mr-2' title='Nuevo'></i>",//NO revisado
            "<i class='mi-done-all font-size-xl font-weight-bold text-success mr-2' title='Aprobado'></i>",
            "<i class='icon-cross2 font-size-base text-danger mr-2' title='Cancelado'></i>",
            "<i class='icon-eye8 font-size-base text-warning mr-2' title='En revisión'></i>",
            "<i class='icon-cart font-size-base text-slate-800 mr-2' title='Enviado a compra'></i>",
            "<i class='icon-bell3 font-size-base text-pink mr-2' title='Listo entrega'></i>",
            "<i class='icon-clipboard2 font-size-base text-slate-800 mr-2' title='Entregado'></i>",
            "<span class='badge badge-mark bg-primary border-primary'></span>",//Comentario
            "<span class='badge badge-mark bg-danger-400 border-danger-400'></span>",
            "<span class='badge badge-mark bg-violet-400 border-violet-400'></span>",
            "<span class='badge badge-mark bg-indigo-800 border-indigo-800'></span>"
        );
        return $status[$st];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    