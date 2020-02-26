<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $id_empleado = $_POST['id_empleado'];
    
    $comentarios = $suministro->get_comentarioPedido($id_pedido);
    $data = array();
    
    foreach ($comentarios as $valor) {
        $data[] = array(
            "comentario"=>comentario($valor['comentario'],$valor['fecha_hora'],$valor['coordinacion'],$valor['id_empleado'],$id_empleado),
        );
    }
    function comentario($comentario,$fecha_hora,$coord,$id_empleado_b,$id_empleado){
        $f = new DateTime($fecha_hora);
        $d = $f->format('d'); $m = $f->format('M'); $g = $f->format('g'); $a = $f->format('a'); $i = $f->format('i');
        $coordinacion = ucwords(mb_strtolower($coord));
        
        
        if($id_empleado == $id_empleado_b){
            $chat = "<li class='media media-chat-item-reverse'>
                        <div class='media-body'>
                            <div class='media-chat-item'>$comentario</div>
                            <div class='font-size-xs text-muted mt-2'>$d $m $g:$i $a</div>
                        </div>
                        <div class='ml-3'></div>
                    </li>";
        }else{
            $chat = "<li class='media'>
                        <div class='mr-3'></div>
                        <div class='media-body'>
                            <div class='media-chat-item'>$comentario</div>
                            <div class='font-size-xs text-muted mt-2'>$coordinacion - $d $m $g:$i $a</div>
                        </div>
                    </li>";
        }
        
        return $chat;
    }
    header('Content-Type: application/json');
    echo json_encode($data);