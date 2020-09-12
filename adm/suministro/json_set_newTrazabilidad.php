 <?php
    require_once './suministro.php';
    $suministro = new suministro();
    $data = array();
            
    if(!empty ($_POST['cod_articulo'])){
        $cod_articulo = $_POST['cod_articulo'];
        $fecha_movimiento = $_POST['fecha_movimiento'];
        $motivo  = $_POST['motivo'];
        $responsable  = $_POST['responsable'];
        $ubicacion  = $_POST['ubicacion'];
        $condicion  = $_POST['condicion'];
        
        $result = $suministro->set_new_trazabilidad($fecha_movimiento, $motivo, $responsable, $ubicacion, $condicion, $cod_articulo);
        $data[] = array('result' => $result, 'type' => 'insert');
        
    }else{
        $data[] = array('result' => "vacio", 'type' => 'insert');
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_FORCE_OBJECT);