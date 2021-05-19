<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    if(!empty($_POST["nombre"])){
        $search = $_POST["nombre"];
        $categorias = $catalogo->get_personal("WHERE nombre LIKE '%$search%' OR apellidos LIKE '%$search%'");
    }else{
        $categorias = $catalogo->get_personal("");
    }
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("nombre" => text_nombre($valor['nombre']." ".$valor['apellidos'],$valor['status']),
                        "apellidos" => text_nombre($valor['apellidos'],$valor['status']),
                        "cargo" => $valor['cargo'],
                        "id_empleado" => $valor['id_empleado'],
                        "nombre_simple" => $valor['nombre']." ".$valor['apellidos'],
                        "departamento" => cargo_email($valor['departamento'],$valor['especialista']),
                        "ambito" => departamento($valor['ambito']),
                        "status" => status($valor['status'],$valor['fecha_baja']),
                        "accion" => "<i class='icon-vcard'></i>"
                        );
        
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
            return "<div>
                    <a class='letter-icon-title'>$text</a>
                </div>";
        }else{
            return "<div>
                    <a class='text-danger letter-icon-title'>$text</a>
                </div>";
        }
        
    }
    function cargo_email($cargo,$email){
        if(!empty($email)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$cargo</a>
                            <div class='text-muted font-size-sm'>$email</div>
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