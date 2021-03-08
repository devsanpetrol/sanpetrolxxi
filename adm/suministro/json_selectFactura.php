<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $categorias = $suministro->get_doctoFactura("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("id_factura" => idfactura($valor['id_factura']),
                        "periodo" => periodo($valor['fecha_emision']),
                        "seriefolio" => foliofactura($valor['serie_folio']),
                        "proveedor" => nombre($valor['nombre'],$valor['direccion']),
                        "fecha_emision" => fecha_emision($valor['fecha_emision']),
                        "total" => total($valor['total']),
                        "accion" => accion($valor['id_factura'])
                        );
    }
    
    function nombre($nombre,$ac){
        $act = trim($ac);
        if(!empty($act)){
        return "<div class='font-weight-semibold text-primary-800'>$nombre</div>
                <div class='text-muted'>$act</div>";
        }else{
            return "<div class='font-weight-semibold text-primary-800'>$nombre</div>";
        }
    }
    function total($total){
        if(!empty($total)){
            $moneda = number_format($total, 2, '.', ', ');
            return "<div class='d-inline-flex align-items-center'>
                        <span class='font-weight-bold'>$</span>
                        <input type='text' class='form-control p-0 border-0 bg-transparent font-weight-bold text-right' readonly value='$moneda'>
                    </div>";
        }else{
            return "";
        }
        
    }
    function idfactura($id_factura){
        return "<h6 class='mb-0 font-size-sm'>$id_factura</h6>";
    }
    function foliofactura($serie_folio){
        $sf = trim($serie_folio);
        if ($sf != ""){
            return "<h6 class='mb-0 font-size-sm'>$sf</h6>";
        }else{
            return "<h6 class='mb-0 font-size-sm'>- -</h6>";
        }
    }
    function periodo($periodo){
        $cadena = $periodo;
        $timestamp = strtotime($cadena);
        $fecha =  date('F Y', $timestamp);
        return "<div class='d-inline-flex align-items-center'>
                <i class='icon-books mr-2'></i>
                <input type='text' class='form-control p-0 border-0 bg-transparent' readonly value='$fecha'>
        </div>";
    }
    function fecha_emision($fecha_emision){
        $cadena = $fecha_emision;
        $timestamp = strtotime($cadena);
        $fecha =  date('F d, Y', $timestamp);
        return "<div class='d-inline-flex align-items-center'>
                <i class='icon-calendar2 mr-2'></i>
                <input type='text' class='form-control p-0 border-0 bg-transparent' readonly value='$fecha'>
        </div>";
    }
    
    function accion($id_factura){
        
    return "<div class='list-icons list-icons-extended'>
                <a href='#' class='list-icons-item'><i class='icon-file-eye' data-idfactura='$id_factura' onclick='openModalFacturaDetail(event)'></i></a>
                <div class='list-icons-item dropdown d-none'>
                    <a href='#' class='list-icons-item dropdown-toggle' data-toggle='dropdown'><i class='icon-file-text2'></i></a>
                    <div class='dropdown-menu dropdown-menu-right'>
                        <a href='#' class='dropdown-item'><i class='icon-file-download'></i> Download</a>
                        <a href='#' class='dropdown-item'><i class='icon-printer'></i> Print</a>
                        <div class='dropdown-divider'></div>
                        <a href='#' class='dropdown-item'><i class='icon-file-plus'></i> Edit</a>
                        <a href='#' class='dropdown-item'><i class='icon-cross2'></i> Remove</a>
                    </div>
                </div>
            </div>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);