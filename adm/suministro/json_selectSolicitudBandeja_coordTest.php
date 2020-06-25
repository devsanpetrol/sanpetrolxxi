<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $user_session_id = $_POST["user_session_id"];
    $id_coordinacion = $_POST["id_coordinacion"];
    if($id_coordinacion == 1 || $id_coordinacion == 2){
        $filter = "WHERE id_coordinacion = $id_coordinacion GROUP BY id_equipo ORDER BY folio DESC";
    }
    if($id_coordinacion == 4){
        $filter = "WHERE firm_coordinacion > 0 GROUP BY id_equipo ORDER BY folio DESC";
    }
    if($id_coordinacion == 0){
        $filter = "WHERE clave_solicita = $user_session_id GROUP BY id_equipo ORDER BY folio DESC";
    }
    $categorias = $suministro->get_solicitudes_($filter);//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha']);
        $d = $date->format('d');
        $m = $date->format('M');
        $folio = $valor['folio'];
        
        $star = "<a href='#'>#$folio</a>";
        
        $data[] = array("star" => "",
                        "status_c" => firma_revision_c($valor['firm_coordinacion']),
                        "status_p" => firma_revision_p($valor['firm_planeacion']),
                        "solicita" => "<span class='font-weight-bold text-blue-800'>".$valor['nombre_generico']."</span>",
                        "pedidos" => "<span class='font-weight-bold text-blue-800'>".$valor['nombre_generico']."</span></br>".pedido($folio,$id_coordinacion),
                        "fecha" => "<span class='font-weight-bold'>$m $d</span></br><h5 class='font-weight-bold text-danger'>".str_pad($folio, 6, "0", STR_PAD_LEFT)."</h5>",
                        "folio" => $folio,
                        "leido" => ""
                        );
        }
    function pedido($folio,$id_coordinacion){
        $filtro = "WHERE folio = $folio";
        $suministro = new suministro();
        $pedidos = $suministro->get_solicitudes_($filtro);
        $lista = array();
        foreach($pedidos as $valor){
                $cantidad = cantidad_user($valor['cantidad'],$valor['cantidad_coord'],$valor['cantidad_plan'],$id_coordinacion);
                $unidad = $valor['unidad'];
                $destino = $valor['nombre_sub_area'];
                $articulo = $valor['articulo'];
                $justificacion = $valor['justificacion'];
                array_push($lista,"<li><span class='table-inbox-subject'><span class='font-weight-bold'>$cantidad $unidad</span> $articulo &nbsp;-&nbsp;</span><span class='badge badge-flat border-teal-300 alpha-teal text-teal-800'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span></li>");
            }
        $todos = implode("", $lista);
        return "<ul class='list-unstyled mb-0'>".$todos."</ul>";
    }
    function cantidad_user($cant, $cant_coord,$cant_plan, $id_coordinacion){
        if( $id_coordinacion == 1 || $id_coordinacion == 2 ){
            return $cant_coord;
        }else if( $id_coordinacion == 4 ){
            return $cant_plan;
        }else {
            return $cant;
        }
    }
    function cantidad_bsoluta($cant_user,$cant_coord,$cant_plan,$firm_coord,$firm_plan){
        if($firm_coord && $firm_plan){
            return $cant_plan;
        }else if($firm_coord && !$firm_plan){
            return $cant_coord;
        }else if(!$firm_coord && $firm_plan){
            return $cant_plan;
        }else if(!$firm_coord && !$firm_plan){
            return $cant_user;
        }
    }
    function t_icon_x($st){
       $status = array(
            "<i class='mi-adjust font-size-xl font-weight-bold text-primary-700 mr-2' title='Nuevo'></i>",//NO revisado
            "<i class='mi-done font-size-xl font-weight-bold text-success mr-2' title='Aprobado'></i>",
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
    function firma_revision_p($firm_planeacion){
        if( $firm_planeacion == 0 ){
            $firma = "<a href='#' class='btn bg-transparent border-grey-300 text-grey-300 rounded-round border-2 btn-icon legitRipple'><i class='icon-paperplane'></i></a>";
        }elseif ( $firm_planeacion > 0 ){
            $firma = "<a href='#' class='btn alpha-success border-success text-success rounded-round border-2 btn-icon legitRipple'><i class='icon-paperplane'></i></a>";
        }
        return $firma;
    }
    function firma_revision_c($firm_coordinacion){
        if( $firm_coordinacion == 0 ){
            $firma = "<a href='#' class='btn bg-transparent border-grey-300 text-grey-300 rounded-round border-2 btn-icon legitRipple'><i class='icon-paperplane'></i></a>";
        }elseif ( $firm_coordinacion > 0 ){
            $firma = "<a href='#' class='btn alpha-success border-success text-success rounded-round border-2 btn-icon legitRipple'><i class='icon-paperplane'></i></a>";
        }
        return $firma;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    