<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $cod_articulo = $_POST['cod_articulo'];
    $categorias = $suministro->verifi_SumArticulo($cod_articulo);
    
    header('Content-Type: application/json');
    
    echo json_encode($categorias);
   