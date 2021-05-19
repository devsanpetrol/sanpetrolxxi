<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $grupos = $suministro->get_grupos();
    $data = array();
    
    foreach ($grupos as $valor) {
        $data[] = array("menu" => css_grupos($valor['grupo_nombre'],$valor['id_grupo_activo'],$valor['contar'],$valor['id_main']),
                        "menu_menu" => css_grupos_menu($valor['grupo_nombre'],$valor['id_grupo_activo'],$valor['contar'],$valor['id_main']),
                        "grupo_nombre" => $valor['grupo_nombre'],
                        "id_grupo_activo" => $valor['id_grupo_activo'],
                        "contar" => $valor['contar'],
                        "id_main" => $valor['id_main']
                        );
    }
    
    function css_grupos($grupos,$id_grupo,$cont,$id_main){
        $cantidad = contador($cont);
        return "<li class='nav-item p-1 subgrupos' style='cursor:pointer'>
                    <a  class='nav-link subgrupos p-1 font-size-sm' data-idgrupo='$id_grupo' onclick='load_main_grupos(event)'>
                        <i class='icon-folder2 icono-grupo text-orange-300' id='".$id_grupo."i' data-grupo='$grupos' data-idgrupo='$id_grupo' data-idmain='$id_main' onclick='hola(event)'></i> $grupos
                        $cantidad
                    </a>
                </li>";
    }
    function css_grupos_menu($grupos,$id_grupo,$cont,$id_main){
        return "<a class='dropdown-item subgrupos' data-title='$grupos' data-idgrupo='$id_grupo' data-idmain='$id_main' onclick='load_main_grupos(event)'><i class='icon-folder2 icono-grupo id='".$id_grupo."i''></i>$grupos</a>";
    }
    function contador($cont){
        if($cont >= 1){
            return "<span class='badge bg-primary align-self-center ml-auto'>$cont</span>";
        }else{
            return "<span class='badge bg-primary badge-pill ml-auto'></span>";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    //<div class='dropdown-divider'></div>
        //<a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>