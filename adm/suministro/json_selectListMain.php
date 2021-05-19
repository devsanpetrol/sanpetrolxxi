<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $grupos = $suministro->get_main();
    $data = array();
    
    foreach ($grupos as $valor) {
        $data[] = array("index_order" => $valor["index_order"],
                        "main" => css_main($valor['main_name'],$valor['id_main']),
                        "main_menu" => css_main_menu($valor['main_name'],$valor['id_main']),
                        "id_main" => $valor['id_main'],
                        "main_name" => $valor['main_name']
                        );
    }
    
    function css_main($main_name,$id_main){
        return "<div class='card all-main'>
                    <div class='card-header bg-transparent header-elements-inline'>
                        <span class='text-uppercase font-size-sm font-weight-semibold'><i class='icon-menu7 mr-2'></i>$main_name</span>
                        <div class='header-elements'>
                            <div class='list-icons'>
                                <a class='list-icons-item' data-action='collapse' onclick='colapsed($id_main)'></a>
                            </div>
                        </div>
                    </div>
                    <div class='card-body p-0 card-id$id_main'>
                        <ul class='nav nav-sidebar misgrupos main-$id_main' data-nav-type='accordion'>
                        </ul>
                    </div>
                </div>";
    }
    function css_main_menu($main_name,$id_main){
        return "<div class='dropdown-submenu'>
                    <a href='#' class='dropdown-item'><i class='icon-folder2'></i>$main_name</a>
                    <div class='dropdown-menu bg-teal main_sub_$id_main'>
                        
                    </div>
                </div>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    
    //<div class='dropdown-divider'></div>
        //<a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>