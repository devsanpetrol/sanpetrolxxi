<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $grupos = $suministro->get_grupos();
    $data = array();
    
    foreach ($grupos as $valor) {
        $data[] = array("menu" => css_grupos($valor['grupo_nombre'],$valor['id_grupo_activo'])
                        );
    }
    
    function css_grupos($grupos,$id_grupo){
        return "<a href='#' class='list-group-item list-group-item-action legitRipple' data-idgrupo='$id_grupo' onclick='selectItems(event)'>
                    <span class='font-weight-semibold'><i class='icon-bookmark2 mr-2'></i>$grupos</span>
                    <span class='badge bg-pink-400 badge-icon ml-auto'></span>
                </a>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    //<div class='dropdown-divider'></div>
        //<a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>