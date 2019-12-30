<?php
    require_once './suministro.php'; 
    
    $cod_articulo = $_POST['cod_articulo'];
    $suministro = new suministro();
    $filtro = "WHERE cod_articulo = '$cod_articulo'";
    $limit = "LIMIT 1";
    $articulo = $suministro->get_almacen($filtro,$limit);
    $category = get_category($cod_articulo);
    $last_cod = $suministro->get_last_codarticulo($category)[0]["cod_articulo"];
    $data = array();
    
    $descripcion = $articulo[0]["descripcion"];
    $unidad = $articulo[0]["tipo_unidad"];
    $stock = $articulo[0]["stock"];
    
    
    for($i=1; $i <= $stock; $i++){
        $serial = get_numbercod($last_cod)+$i;
        $numer_cod_articulo = get_newcodarticulo($category,$serial);
        $data[] = array("status" => status($numer_cod_articulo),
                        "cod_articulo" => $numer_cod_articulo,
                        "descripcion" => $descripcion,
                        "unidad" => $unidad,
                        "no_serie" => no_serie($numer_cod_articulo),
                        "no_inventario" => no_inventario($numer_cod_articulo),
                        "accion" => accion($numer_cod_articulo));
    }
    
    
    function no_serie($numer_cod_articulo){
        return "<input type='text' class='form-control form-control-sm font-weight-semibold text-blue-800' id='ser_$numer_cod_articulo'>";
    }
    function no_inventario($numer_cod_articulo){
        return "<input type='text' class='form-control form-control-sm font-weight-semibold text-blue-800' id='inv_$numer_cod_articulo'>";
    }
    function get_category($cod_articulo){//extrae la cateria del codigo
        return preg_replace('/\d/', '', $cod_articulo );
    }
    function get_newcodarticulo($category,$serial_numer){//ingresa un numero y concatena con categoria
        return $category.str_pad($serial_numer, 4, "0", STR_PAD_LEFT);
    }
    function get_numbercod($cod_articulo){ //obtiene el numero de la cadena
        return (int)substr($cod_articulo, -4);
    }
    function accion($numer_cod_articulo){
        return "<button type='button' class='btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm' data-numercodarticulo='$numer_cod_articulo' id='$numer_cod_articulo' onclick='guarda_inventario(event)'><i class='icon-checkmark4'></i></button>";
    }
    function status($numer_cod_articulo){
        return "<i class='icon-price-tag3 text-slate-300' id='ico_$numer_cod_articulo'></i>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);