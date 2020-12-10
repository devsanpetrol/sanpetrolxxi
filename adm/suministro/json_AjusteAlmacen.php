<?php
    require_once './suministro.php'; 
    
    $almacen = new suministro();
    $data = array();
    if(!empty($_POST["cod_articulo"])){
        $cantidad = $_POST["cantidad"];
        $cod_articulo = $_POST["cod_articulo"];
        $comentario = $_POST["comentario"];
        if($cantidad < 0){
            $cantidad = ($cantidad) * (-1);
            update_temAlmacen($cod_articulo,$cantidad);
            ajuste($codarticulo,$cantidad,$comentario);
            $data[] = array("resultado" => 1,"msj"=>"ok" ); //1 - ok en operacion restar
        }else if ($cantidad > 0){
            if(countfactura($cod_articulo) > 0){
                $result = insertNewArticle($cod_articulo,$cantidad);
                if($result){
                    $data[] = array("resultado" => 2,"msj"=>"ok" ); //2 - ok en operacion sumar
                    ajuste($codarticulo,$cantidad,$comentario);
                }else{
                    $data[] = array("resultado" => 2,"msj"=>"fail" ); //2 - ok en operacion sumar
                }
            }else{
                $data[] = array("resultado" => 2,"msj"=>"no_exist" ); //2 - ok en operacion sumar
            }
        }
    }
    
    function update_temAlmacen($codarticulo,$cant_surtir){
        $suministro2 = new suministro();
        $suministro2 -> set_valesalidaDetail_Ajuste($codarticulo,$cant_surtir);
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
    
    function insertNewArticle($codarticulo,$cantidad){
        $buscar = new suministro();
        $newFactutra = $buscar -> set_update_EntradaAjuste($codarticulo,$cantidad);
        
        if($newFactutra){
            $updStockAlm = $buscar -> set_valesalidaDetail_Ajuste_add($codarticulo,$cantidad);
            return $updStockAlm;
        }else{
            return false;
        }
    }
    
    function countfactura($codarticulo){
        $buscar = new suministro();
        $cont = $buscar -> getcountfactura($codarticulo);
        return $cont;
    }
    function ajuste($codarticulo,$cantidad,$comentario){
        $buscar = new suministro();
        $cont = $buscar -> set_ajusteAuditoria($codarticulo,$cantidad,$comentario);
        return $cont;
    }
    header('Content-Type: application/json');
    echo json_encode($data);