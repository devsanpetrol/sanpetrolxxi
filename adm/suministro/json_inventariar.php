<?php
    require_once './suministro.php'; 
    
    $cod_articulo = $_POST['cod_articulo'];
    $categoria    = $_POST['categoria'];
    $suministro   = new suministro();
    $detail   = $suministro -> get_detailAvailableFactura($cod_articulo);
    $last_cod = $suministro->get_last_codarticulo($categoria);
    
    if(!empty($last_cod)){
        $last_cod = $last_cod[0]["cod_articulo"];
    }else{
        $last_cod = $categoria."0001";
    }
    
    $data = array();
    $count = 0;
    foreach ($detail as $valor){
        for($i=1; $i <= $valor["restante"]; $i++){
            $serial = get_numbercod($last_cod)+$count++;
            $numer_cod_articulo = get_newcodarticulo($categoria,$serial);
            $data[] = array("status" => status($numer_cod_articulo),
                            "cod_articulo" => $numer_cod_articulo,
                            "descripcion" => $valor["descripcion"],
                            "unidad" => $valor["tipo_unidad"],
                            "no_serie" => no_serie($numer_cod_articulo),
                            "no_inventario" => no_inventario($numer_cod_articulo),
                            "costo" => costo($numer_cod_articulo,$valor["precio_unidad"]),
                            "costo_display" => $valor["precio_unidad"],
                            "especificacion" => especificacion($numer_cod_articulo),
                            "accion" => accion($cod_articulo,$valor["id_factura_detalle"],$numer_cod_articulo));
        }
    }
    function especificacion($numer_cod_articulo){
        return "<input type='text' class='form-control form-control-sm font-weight-semibold text-blue-800' id='esp_$numer_cod_articulo'>";
    }
    function no_serie($numer_cod_articulo){
        return "<input type='text' class='form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase' id='ser_$numer_cod_articulo'>";
    }
    function no_inventario($numer_cod_articulo){
        return "<input type='text' class='form-control form-control-sm font-weight-semibold text-blue-800 text-uppercase' id='inv_$numer_cod_articulo'>";
    }
    function costo($cod_articulo,$precio_unidad){
        $precio_u = trim($precio_unidad);
        return "<input type='text' class='text-center' value='$precio_u' disabled id='cos_$cod_articulo'>"; 
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
    function accion($numer_cod_articulo,$id_factura_detalle,$new_cod_inventario){
        return "<button type='button' class='btn alpha-primary text-primary-800 btn-icon ml-2 legitRipple btn-sm' data-numercodarticulo='$new_cod_inventario' data-inventariado='no' id='$numer_cod_articulo' data-idfacturadetalle='$id_factura_detalle' onclick='guarda_inventario(event)'>Ok</button>";
    }
    function status($numer_cod_articulo){
        return "<i class='icon-price-tag3 text-slate-300' id='ico_$numer_cod_articulo'></i>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);