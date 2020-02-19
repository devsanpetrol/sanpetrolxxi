<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $user_session_id = $_POST["user_session_id"];
    $categorias = $suministro->get_solicitudes_("WHERE id_coordinacion = 1 AND clave_solicita = $user_session_id GROUP BY id_equipo");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($categorias as $valor) {
        $date = new DateTime($valor['fecha']);
        $d = $date->format('d');
        $m = $date->format('M');
        $folio = $valor['folio'];
        
        $star = "<a href='#'>#$folio</a>";
        
        $equipo = "<span class='font-weight-bold text-teal-800'>".$valor['nombre_generico']."</span>";
        $data[] = array("star" => "",
                        "foto" => "",
                        "solicita" => $equipo,
                        "pedidos" => pedido($folio),
                        "fecha" => "<span class='font-weight-bold'>$m $d</span>",
                        "folio" => "",
                        "leido" => ""
                        );
        }
    function pedido($folio){
        $filtro = "WHERE id_coordinacion = 1 AND folio = $folio";
        $suministro = new suministro();
        $pedidos = $suministro->get_solicitudes_($filtro);
        $lista = array();
        foreach($pedidos as $valor){
                $cantidad = $valor['cantidad'];
                $unidad = $valor['unidad'];
                $destino = $valor['nombre_sub_area'];
                $articulo = $valor['articulo'];
                $justificacion = $valor['justificacion'];
                array_push($lista,"<li><span class='table-inbox-subject'><span class='font-weight-bold'>$cantidad $unidad</span> $articulo &nbsp;-&nbsp;</span><span class='badge badge-flat border-teal-300 alpha-teal text-teal-800'>$destino</span> <span class='text-muted font-weight-normal'>$justificacion</span></li>");
            }
        $todos = implode("", $lista);
        return "<ul class='list-unstyled mb-0'>".$todos."</ul>";
    }
    function pedido_count($folio,$user_session_id){
        $filtro = "AND autoriza = ".$user_session_id;
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_count($folio,$filtro);
        return $pedidos[0]['c'];
    }
    function foto($contar, $leido){
        if($leido == 0){
            return "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/userlogin.jpg' class='rounded-circle' width='32' height='32' alt=''><span class='badge badge-danger badge-pill badge-float'>$contar</span></a>";
        }else{
            return "<a href='#' class='position-relative'><img src='../../global_assets/images/placeholders/userlogin.jpg' class='rounded-circle' width='32' height='32' alt=''><span class='badge bg-slate-300 badge-pill badge-float'>$contar</span></a>";
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
    header('Content-Type: application/json');
    echo json_encode($data);
    
    