<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $data = array();
    
    if(!empty($_POST["id_empleado"])){
        $search = $_POST["id_empleado"];
        $categorias = $catalogo -> get_solicitudes_("WHERE id_solicita = $search AND id_equipo = 19");
        
        foreach ($categorias as $valor) {
        $data[] = array("articulo" => cargo_email($valor['articulo'],$valor['cod_articulo']),
                        "fecha" => text($valor['fecha_requerimiento'])
                        );
        }
    }
    
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>
                <div class='font-size-sm text-muted line-height-1'>$unidad</div>";
    }
    function text($text){
        return "<h6 class='mb-0 font-size-sm font-weight-semibold'>$text</h6>";
    }
    function text_nobold($text){
        return "<h6 class='mb-0 font-size-sm font-weight-bold'>$text</h6>";
    }
    function text_nombre($text,$status){
        if($status == 1){
            return "<h6 class='mb-0 font-size-sm font-weight-bold'>$text</h6>";
        }else{
            return "<h6 class='mb-0 font-size-sm font-weight-bold text-danger'>$text</h6>";
        }
        
    }
    function cargo_email($cargo,$email){
        if(!empty($email)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$cargo</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $email</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$cargo</a>
                        </div>
                    </div>";
        }
    }
    function status($status,$fecha_baja){
        if($status == 1){
            return "<span class='badge d-block badge-success'>Activo</span>";
        }else{
            return "<span class='badge d-block badge-danger' title='Fecha de baja: $fecha_baja'>Baja</span>";
        }
    }
    function costo($costo){
        if(!empty($costo)){
            $moneda = number_format($costo, 2, ',', ' ');
            return "<h6 class='font-weight-semibold text-primary-800 mb-0'>$ $moneda</h6>";
        }else{
            return "";
        }
    }
    function departamento($departamento){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$departamento</h6>";
    }
    header('Content-Type: application/json');
    echo json_encode($data);