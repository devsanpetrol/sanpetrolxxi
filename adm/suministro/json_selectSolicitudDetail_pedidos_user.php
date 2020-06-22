<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_solicitudes_("WHERE folio = $folio");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    foreach ($pedidos as $valor){
        $id_pedido = $valor["id_pedido"];
        $data[] = array("id_pedido" => $id_pedido,
                        "articulo" => articulo($valor["articulo"],$id_pedido,$valor["unidad"],$valor["cod_articulo"],$valor["justificacion"],$valor["cantidad"]),
                        "cantidad" => cantidad_user($valor["cantidad"],$valor["cantidad_coord"],$valor["cantidad_plan"],$valor["firm_coordinacion"],$valor["firm_planeacion"]),
                        "unidad" => unidad($valor["unidad"]),
                        "justificacion" => detalle($valor["justificacion"],$valor["nombre_sub_area"]),
                        "destino" => $valor["destino"],
                        "status_pedido" => status_pedido($valor["status_pedido"],$id_pedido),//$valor["status_pedido"],
                        "fecha_requerimiento" => $valor["fecha_requerimiento"],
                        "cantidad_coord" => cantidad_coord($valor["cantidad_coord"],$valor["cantidad_plan"],$valor["firm_coordinacion"],$valor["firm_planeacion"],$id_pedido),
                        "cantidad_plan" => cantidad_plan($valor["cantidad_plan"],$valor["firm_planeacion"],$id_pedido),
                        "cantidad_surtido" => $valor["cantidad_surtido"],
                        "cantidad_pendiente" => $valor["cantidad_pendiente"],
                        "cod_articulo" => $valor["cod_articulo"],
                        "comentarios" => comentario($valor["last_comentario"],$valor["count_comentario"],$id_pedido),
                        "last_comentario" => $valor["last_comentario"],
                        "count_comentario" => $valor["count_comentario"],
                        "id_sub_area" => $valor["id_sub_area"]
                    );
    }
    function cantidad($id_pedido, $cantidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800' id='cantidad_$id_pedido' data-idpedido='$id_pedido'>$cantidad</h6>";
    }
    function unidad($unidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-blue-800'>$unidad</h6>";
    }
    function destino($destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-700'>$destino</h6>";
    }
    function articulo($articulo,$id_pedido,$unidad,$cod_articulo,$justificacion,$cantidad){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$articulo <i class='icon-pencil mr-3 text-blue-600' data-articulo='$articulo' data-idpedido='$id_pedido' data-unidad='$unidad' data-codarticulo='$cod_articulo' data-justificacion='$justificacion' data-cantidad='$cantidad' onclick='openModalEditArticle(event)'></i></h6>";
    }
    function justificacion($justificacion){
        return "<h6 class='mb-0 font-size-sm text-slate-700'>$justificacion</h6>";
    }
    function detalle($justificacion,$destino){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$destino </h6>
                <span class='d-block font-size-sm text-blue-800'>$justificacion</span>";
    }
    function status_pedido($status_pedido,$id_pedido){
        $status = "";
        switch ($status_pedido) {
            case 0:
                $status = "<span class='badge badge-flat border-primary text-primary-600 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Nuevo</span>";
                break;
            case 1:
                $status = "<span class='badge badge-success d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Aprobado</span>";
                break;
            case 2:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Cancelado</span>";
                break;
            case 3:
                $status = "<span class='badge bg-purple-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Surtir</span>";
                break;
            case 4:
                $status = "<span class='badge badge-primary d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Completado</span>";
                break;  
            case 5:
                $status = "<span class='badge bg-info-300 d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Compra</span>";
                break;
            case 6:
                $status = "<span class='badge badge-danger d-block' data-idpedido='$id_pedido' onClick='openMiniModalStatus(event)'>Anulado</span>";
                break;
         }
        
        return $status;
    }
    function comentario($comentario,$count,$id_pedido){
        $count2 = $count-1;
        
        if(!empty($comentario)){
            if($count2 > 1){
                $result =  "<blockquote class='blockquote d-flex mb-0 text-right'>
                            <div class='mr-auto'>
                                <p class='mb-1 font-size-sm text-primary-800'>$comentario.</p>
                            </div>
                            <div class='ml-2 align-self-start'>
                                <button type='button' class='btn btn-outline bg-danger-400 text-danger-800 btn-icon ml-2 rounded-round legitRipple' title='$count2 comentarios más' onClick='openCardComent($id_pedido)'><i class='icon-bubbles5'></i></button>
                            </div>
                        </blockquote>";
            }else{
               $result= "<blockquote class='blockquote d-flex mb-0 text-right'>
                            <div class='mr-auto'>
                                <p class='mb-1 font-size-sm text-primary-800'>$comentario.</p>
                            </div>
                            <div class='ml-2 align-self-start'>
                                <button type='button' class='btn btn-outline bg-danger-400 text-danger-800 btn-icon ml-2 rounded-round legitRipple'  onClick='openCardComent($id_pedido)'><i class='icon-bubbles5'></i></button>
                            </div>
                        </blockquote>";
            }
        }else{
            $result= "<blockquote class='blockquote d-flex mb-0 text-right'>
                            <div class='mr-auto'>
                                <p class='mb-1 font-size-sm'></p>
                            </div>
                            <div class='ml-2 align-self-start'>
                                <button type='button' class='btn btn-outline text-slate-300 btn-icon ml-2 rounded-round legitRipple' title='Agregar comentario' onClick='openCardComent($id_pedido)'><i class='icon-bubbles6'></i></button>
                            </div>
                        </blockquote>";
        }
        return $result;
    }
    function autorizacion($id_pedido,$cod_articulo,$cantidad_comprar,$id_compra_lista,$aprobado,$cantidad_cancelado){
        if( $aprobado == 1 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-checkmark-circle text-success'></i>
                    </div>";
        }else if( $aprobado == 2 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-cross text-danger-800' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 3 ){
            return "<div class='d-block form-text text-center'>
                        <i class='icon-checkmark-circle text-success'></i>
                        <i class='icon-info22 text-primary' title='Se canceló ( $cantidad_cancelado ) unidad(es)'></i>
                    </div>";
        }else if( $aprobado == 0 ){
            return "<div class='custom-control custom-control-right custom-checkbox custom-control-inline'>
                        <input type='checkbox' class='custom-control-input' data-cantidadsurtir='$cantidad_comprar' data-idpedido='$id_pedido' data-codarticulo='$cod_articulo' data-idcompralista='$id_compra_lista' id='A$id_compra_lista' checked>
                        <label class='custom-control-label position-static' for='A$id_compra_lista'></label>
                    </div>";
        }
    }
    function cantidad_user($cant, $cant_coord,$cant_plan,$firm_coord,$firm_plan){
        if($firm_coord){
            if($firm_plan){
                return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_plan</h6>";
            }else{
                return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_coord</h6>";
            }
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant</h6>";
        }        
    }
    function cantidad_coord($cant_coord,$cant_plan,$firm_coord,$firm_plan,$id_pedido){
        if($firm_coord){
            if($firm_plan){
                return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_plan</h6>";
            }else{
                return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_coord</h6>";
            }
        }else{
            return "<input type='text' class='form-control font-weight-semibold text-danger-800 text-center input-cantidad-coord' id='cantidad_$id_pedido' data-idpedido='$id_pedido' placeholder='0' onkeypress='mybind(event)' onkeyup='mayus(this);' value='$cant_coord'>";
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_coord</h6>";
        }
    }
    function cantidad_plan($cant_plan,$firm_plan,$id_pedido){
        if($firm_plan){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-slate-600'>$cant_plan</h6>";
        }else{
            return "<input type='text' class='form-control font-weight-semibold text-danger-800 text-center input-cantidad-coord' id='cantidad_$id_pedido' data-idpedido='$id_pedido' placeholder='0' onkeypress='mybind(event)' onkeyup='mayus(this);' value='$cant_plan'>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);