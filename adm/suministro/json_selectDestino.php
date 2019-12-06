<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    if(!isset($_POST['searchTerm'])){ 
        $articulos = $suministro->get_almacen_destino_5();
    }else{ 
      $searchTerm = $_POST['searchTerm'];   
      $articulos = $suministro->get_almacen_destino($searchTerm);
    }
    $data = array();
    
    foreach ($articulos as $valor) {
        $data[] = array("id"=>$valor['key_wh'], "text"=>$valor['destino']." (".$valor['tipo'].")");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   