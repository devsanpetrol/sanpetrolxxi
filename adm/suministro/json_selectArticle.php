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
        if(empty($valor['no_inventario'])){
            $data[] = array("id"=>$valor['cod_articulo'], "text"=>$valor['descripcion']." (".$valor['stock'].")");
        }else{
            if($valor['stock'] > 0){
                $data[] = array("id"=>$valor['cod_articulo'], "text"=>$valor['descripcion']." (".$valor['no_inventario'].")");
            }else{
                $data[] = array("id"=>$valor['cod_articulo'], "text"=>$valor['descripcion']." (".$valor['no_inventario'].")(No Disponible)");
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
   