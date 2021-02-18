<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $cod_articulo = $_POST["cod_articulo"];
    $categorias = $suministro->get_movimiento("WHERE cod_articulo = '$cod_articulo' order by fecha_registro desc");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("responsable" => nombre($valor['responsable'],$valor['motivo']),
                        "fecha" => rfc($valor['fecha_movimiento']),
                        "id_traza" => rfc($valor['id_traza']),
                        "ubicacion" => rfc($valor['ubicacion']),
                        "condicion" => rfc($valor['condicion'])
                        );
    }
    function nombre($nombre,$ac){
        $act = trim($ac);
        if(!empty($act)){
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre</h6>
                    <div class='text-muted font-size-sm'><span class='badge badge-mark border-grey-400 mr-1'></span>$act</div>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre</h6>";
        }
    }
    function rfc($rfc){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$rfc</h6>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);