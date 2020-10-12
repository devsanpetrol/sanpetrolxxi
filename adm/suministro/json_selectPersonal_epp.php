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
                        "cargo" => cargo_email($valor['cargo'],$valor['email']),
                        "departamento" => cargo_email($valor['departamento'],$valor['especialista']),
                        "ambito" => departamento($valor['ambito']),
                        "status" => status($valor['status'],$valor['fecha_baja']),
                        "accion" => accion($valor['id_empleado'],$valor['status'],$valor['nombre']." ".$valor['apellidos'])
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
    function accion($id_empleado,$status,$nombre){
        return "<i class='icon-books' id='Y$id_empleado' data-idempleado='$id_empleado' data-nombre='$nombre' onclick='buscar_historico(event)' style='cursor: pointer'></i>";
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