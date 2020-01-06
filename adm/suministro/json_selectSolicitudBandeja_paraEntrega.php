<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $filtro = filtro("todo");
    $categorias = $suministro->get_solicitud_aprobacion_entrega($filtro);
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
                        "revisado" => revisado($valor['status_vale']),
                        "folio" => $folio,
                        "justificacion" => $folio,
                        "status_vale" => $valor['status_vale'],
                        "grupo" => grupo($valor['status_vale'])
                        );
    }
    
    function pedido($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_salida($folio);
        $lista = array();
        foreach($pedidos as $valor){
                $cantidad = $valor['cantidad_aprobado'];
                $unidad = $valor['unidad'];
                $destino = $valor['destino'];
                $articulo = $valor['articulo'];
                $justificacion = $valor['justificacion'];
                $aprobado = aprobado($valor['aprobado']);
                array_push($lista," <span class='table-inbox-subject'>$aprobado ($cantidad $unidad) $articulo &nbsp;&nbsp;</span><span class='badge badge-flat border-grey text-grey-600'>$destino</span>");// <span class='text-muted font-weight-normal'>$justificacion</span>
            }
        $todos = implode("</br>", $lista);
        return $todos;
    }
    function cantidad_alter($cantidad_surtir,$cantidad_aprobado,$status_vale){
        /*if(){
            
        }else{
            
        }*/
    }
    function pedido_count($folio){
        $suministro = new suministro();
        $pedidos = $suministro->get_pedidos_count($folio);
        return $pedidos[0]['c'];
    }
    function revisado($status_vale){
        if($status_vale == 2){
            return "<div class='d-block form-text text-center text-slate'>
                        <i class='icon-clipboard2'></i>
                    </div>";
        }else if($status_vale == 1){
            return "<div class='d-block form-text text-center text-indigo-800'>
                        <i class='icon-clipboard'></i>
                    </div>";
        }
    }
    function aprobado($aprobado){//icon-clipboard
        if($aprobado == 1 || $aprobado == 3){
            return "<i class='icon-checkmark2 text-success-800'></i>";
        }else if($aprobado == 2){
            return "<i class='icon-cross text-danger-800'></i>";
        }else{
            return "<span class='badge badge-mark bg-info-400 border-info-400'></span>";
        }
    }
    function filtro($filtro){
        if($filtro == "todo"){
            return "WHERE status_vale IN ( 1 , 2)";
        }else if($filtro == "no_revisado"){
            return "WHERE status_vale = 1";
        }else if($filtro == "si_revisado"){
            return "WHERE status_vale = 2";
        }
    }
    function grupo($status){
        if($status == 1){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>SALIDAS APROBADAS</h6>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>ENTREGADAS</h6>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    