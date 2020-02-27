<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $id_pedido = $_POST['id_pedido'];
    $id_empleado = $_POST['id_empleado'];
    
    $comentarios = $suministro->get_comentarioPedido($id_pedido);
    $data = array();
    
    foreach ($comentarios as $valor) {
        $data[] = array(
            "comentario"=>comentario($valor['comentario'],$valor['fecha_hora'],$valor['coordinacion'],$valor['id_empleado'],$id_empleado,$valor['ahora']),
        );
    }
    function comentario($comentario,$fecha_hora,$coord,$id_empleado_b,$id_empleado,$ahora){
        $f = new DateTime($fecha_hora);
        $Y = $f->format('Y');$d = $f->format('d'); $m = $f->format('M'); $g = $f->format('g'); $a = $f->format('a'); $i = $f->format('i');$w = $f->format('W');
        $f2 = new DateTime($ahora);
        $Y2 = $f2->format('Y');$d2 = $f2->format('d'); $m2 = $f2->format('M'); $g2 = $f2->format('g'); $a2 = $f2->format('a'); $i2 = $f2->format('i');$w2 = $f2->format('W');
        $coordinacion = ucwords(mb_strtolower($coord));
        $hace = $i2 - $i;
        $date_msj = "$d $m $Y";
        $color_text ="text-muted";
        if($Y == $Y2){
            $date_msj = "$d $m $g:$i $a";
            if($m == $m2 && $d == $d2){
                $date_msj = "Hoy $g:$i $a";
                $color_text ="text-default";
                if($g == $g2 && $a == $a2){
                    $date_msj = "Hace " . $hace . " minutos";
                    $color_text ="text-primary-800";
                    if($i == $i2){
                        $date_msj = "Ahora";
                        $color_text ="text-primary-800";
                    }
                }
            }
        }
        
        if($id_empleado == $id_empleado_b){
            $chat = "<li class='media media-chat-item-reverse'>
                        <div class='media-body'>
                            <div class='media-chat-item'>$comentario</div>
                            <div class='font-size-xs $color_text mt-2'>$date_msj</div>
                        </div>
                        <div class='ml-3'></div>
                    </li>";
        }else{
            $chat = "<li class='media'>
                        <div class='mr-3'></div>
                        <div class='media-body'>
                            <div class='media-chat-item'>$comentario</div>
                            <div class='font-size-xs $color_text mt-2'>$coordinacion - $date_msj</div>
                        </div>
                    </li>";
        }
        
        return $chat;
    }
    header('Content-Type: application/json');
    echo json_encode($data);