<?php
    require_once './suministro.php'; 
    
    $almacen = new suministro();
    $data = array();
    if(!empty($_POST["cod_articulo"])){
        $search = $_POST["cod_articulo"];
        $categorias = $almacen->get_tableAlmacen("WHERE cod_articulo = '$search'");
        
        foreach ($categorias as $valor) {
        $data[] = array("descripcion" => "(".$valor['stock'].") - ".$valor['descripcion'].". - ".$valor['marca'],
                        "stock" => $valor['stock'],
                        "marca" => $valor['marca'],
                        "nombre_categoria" => $valor['nombre_categoria'],
                        "error" => 0,
                        "error_detail" => ""
                        );
        
    }
    }else{
        $data[] = array("descripcion" => "",
                        "stock" => "",
                        "marca" => "",
                        "nombre_categoria" => "",
                        "error" => 1,
                        "error_detail" => "Ingrese un código"
                        );
    }
    
    function update_temAlmacen($codarticulo,$cant_surtir){
        $suministro2 = new suministro();
        $catego = $suministro2 -> exe_factura_detalle($codarticulo);
        $factor = 0;

        foreach ($catego as $valor) {
            $factor  += $valor['restante'];
            $restante = $factor - $cant_surtir;
            if($factor >= $cant_surtir){
                $catego2 = $suministro2->set_update_almacenArticleSub($valor['id_factura_detalle'], $restante);
                break;
            }else{
                $catego2 = $suministro2->set_update_almacenArticleSub($valor['id_factura_detalle'], 0);
            }
        }
    }
    
    
    header('Content-Type: application/json');
    echo json_encode($data);