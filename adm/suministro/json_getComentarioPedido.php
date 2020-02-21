<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $comentarios = $suministro->get_comentarioPedido($id_pedido);
    $data = array();
    
    foreach ($comentarios as $valor) {
        $data[] = array(
            "id_pedido_comentario"=>$valor['id_pedido_comentario'],
            "id_pedido"=>$valor['id_pedido'],
            "comentario"=>comentario($valor['comentario'],$valor['fecha_hora'],ucwords(mb_strtolower($valor['coordinacion']))),
            "fecha_hora"=>$valor['fecha_hora'],
            "id_empleado"=>$valor['id_empleado'],
            "coordinacion"=>$valor['coordinacion'],
            "nombre"=>$valor['nombre'],
            "apellidos"=>$valor['apellidos']
            );
    }
    function comentario($comentario,$fecha_hora,$coordinacion){
        $date = new DateTime($fecha_hora);
        $d = $date->format('d');
        $m = $date->format('M');
        $g = $date->format('g');
        $a = $date->format('a');
        $i = $date->format('i');
        
        return "<li class='media media-chat-item-reverse'><div class='media-body'>
                    <div class='media-chat-item font-size-sm'>$comentario</div>
                    <div class='font-size-xs text-muted mt-2'>$coordinacion - $d $m $g:$i $a<i class='icon-comments ml-2 text-muted'></i></div>
                </div></div>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);