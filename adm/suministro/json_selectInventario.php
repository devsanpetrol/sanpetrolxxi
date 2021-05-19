<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $filtro = $_POST["filtro"];
    $categorias = $suministro->get_activofijo($filtro);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("cod_articulo" => $valor['cod_articulo'],
                        "none" => '',
                        "no_inventario" => $valor['no_inventario'],
                        "no_serie" => $valor['no_serie'],
                        "descripcion" => $valor['descripcion'],
                        "tipo_unidad" => $valor['tipo_unidad'],
                        "status" => status_disponible("checkmark-circle","cancel-circle2",$valor['status'],"success","danger"),
                        "disponible" => status_disponible("checkmark-circle","lock4",$valor['disponible'],"primary","slate"),
                        "operable" => status_disponible("checkmark-circle","cancel-circle2",$valor['operable'],"success","danger"),
                        "marca" => $valor['marca'],
                        "grupo" => grupo($valor['id_grupo_activo'],$valor['grupo_nombre']),
                        "nombre_categoria" => $valor['nombre_categoria'],
                        "accion" => accion($valor['cod_articulo'],$valor['no_inventario'],$valor['id_factura'],$valor['id_grupo_activo'],$valor['disponible'],$valor['descripcion'])
                        );
        
    }
    
    function stock_min_max($cantidad){
        return "<h6 class='mb-0'>$cantidad</h6>";
    }
    function accion($cod_articulo,$no_inventario,$id_factura,$id_grupo,$disponible,$descripcion){
        $inve  = "";
        $prop = "";
        $fact = "";
        $disp="";
        if(empty($no_inventario)){
            $inve = "<a class='dropdown-item' data-codarticulo='$cod_articulo' onclick='inventarear(event)' id='inv_$cod_articulo'><i class='icon-price-tag2'></i> Inventariar</a>";
        }
        if(!empty($cod_articulo)){
            $prop = "<a class='dropdown-item' id='X$cod_articulo' data-codarticulo='$cod_articulo' onclick='propiedadArticle(event)'><i class='icon-clippy'></i> Propiedades</a>";
        }
        if(!empty($id_factura)){
            $fact = "<a class='dropdown-item' id='Z$cod_articulo' data-codarticulo='$cod_articulo' data-idfactura='$id_factura' onclick='openModalFacturaDetail(event)'><i class='icon-certificate'></i> Ver Factura</a>";
        }
        if($disponible == 1){
            $disp = "<a class='dropdown-item' id='b$cod_articulo' data-codarticulo='$cod_articulo' data-descripcion='$descripcion' onclick='abre_modal_asigna(event)'><i class='icon-user-check'></i> Asignar a...</a>";
        }
        $grup = "<a class='dropdown-item' id='A$cod_articulo' data-codarticulo='$cod_articulo' data-idgrupo='$id_grupo' onclick='mofificar_grupo(event)'><i class='icon-folder2'></i> Mover a carpeta...</a>";
    return "<div class='list-icons'>
                <div class='dropdown'>
                    <a href='#' class='list-icons-item' data-toggle='dropdown'>
                        <i class='icon-menu7'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right bg-teal'>
                        $prop
                        $inve
                        $fact
                        $grup
                        $disp
                        <a class='dropdown-item' id='Y$cod_articulo' data-codarticulo='$cod_articulo' onclick='openTrazabilidad(event)'><i class='icon-versions'></i> Trazabilidad</a>
                    </div>
                </div>
            </div>";
    }
    function grupo($id_grupo,$grupo){
        if($id_grupo > 1){
            return $grupo;
        }
    }
    function nombre_categoria($nombre_categoria){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
    }
    function status_disponible($text1,$text2,$status,$color1,$color2){
        if($status == 1){
            return "<i class='icon-$text1 text-$color1'></i>si"; // checkmark-circle cancel-circle2 icon-lock4
        }else{
            return "<i class='icon-$text2 text-$color2'></i>no";
        }
    } 
    header('Content-Type: application/json');
    echo json_encode($data);