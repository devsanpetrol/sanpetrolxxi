<?php
    require_once './suministro.php';
    
    $suministro = new suministro();
    $data = array();
    
    if(isset($_POST['id_factura'])){
        
        $stat_fact = $suministro->update_factura_detail($_POST['id_factura'], mb_strtoupper($_POST['serie_folio']), $_POST['tipo'], $_POST['observacion']);
        
        if($stat_fact){
            $data[] = array(
                "resultado" => "Actualizacion con exito!",
                "status" => "ok"
            );
        }else{
            $data[] = array(
                "resultado" => "Error al actualizar",
                "status" => "fail"
            );
        }
    }else{
        $data[] = array(
            "resultado" => "No existe un ID relacionado.",
            "status" => "empty"
        );
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);