<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $grupos = $suministro->get_personal();
    $data = array();
    
    foreach ($grupos as $valor) {
        $data[] = array("nombre" => nombre_cargo($valor['nombre'],$valor['apellidos'],$valor['cargo']),
                        "id_empleado" => $valor['id_empleado']
                        );
    }
    function nombre_cargo($nombre, $apellido, $cargo){
        return $nombre." ".$apellido." (".$cargo.")";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    //<div class='dropdown-divider'></div>
        //<a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>