<?php
require_once './suministro.php';
$suministro = new suministro();
    
    //DATOS DEL NUEVO VALE DE SALIDA
    if(!empty($_POST["folio"])){
        $dp = $suministro -> get_create_vale_salida($_POST["folio"]);
        $folio_salida = $suministro -> set_new_valesalida_rapido($dp[0]["folio"],$dp[0]["nombre_solicitante"],$dp[0]["fecha"]);
        foreach ($dp as $valor){
            update_temAlmacen($folio_salida,$valor["id_pedido"],$valor["cod_articulo"],$valor["cantidad"]);
        }
    }
    
    function update_temAlmacen($folio_vale,$id_pedido,$codarticulo,$cant_surtir){
        $suministro2 = new suministro();
        $suministro2 -> set_valesalidaDetail_rapido($folio_vale,$id_pedido,$codarticulo,$cant_surtir);
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
    echo json_encode($dp);

