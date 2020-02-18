<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    if(!isset($_POST['searchTerm'])){ 
        $articulos = $suministro->get_almacen_busqueda_5();
    }else{ 
        $searchTerm = $_POST['searchTerm'];   
        $articulos = $suministro->get_almacen_busqueda($searchTerm);
    }
    $data = array();
    
    foreach ($articulos as $valor) {
        if(empty($valor['marca'])){
            $data[] = array("id"=>$valor['cod_articulo'], "text"=>$valor['descripcion']);
        }  else {
            $data[] = array("id"=>$valor['cod_articulo'], "text"=>$valor['descripcion']." (".$valor['marca'].")");
        }
        
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   