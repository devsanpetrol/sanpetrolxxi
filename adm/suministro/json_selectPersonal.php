<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $categorias = $catalogo->get_personal("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("nombre" => text_nobold($valor['nombre']),
                        "apellidos" => text_nobold($valor['apellidos']),
                        "cargo" => cargo_email($valor['cargo'],$valor['email']),
                        "departamento" => cargo_email($valor['departamento'],$valor['especialista']),
                        "ambito" => departamento($valor['ambito']),
                        "accion" => accion($valor['id_empleado'])
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
    function stock_min_max($cantidad){
        return "<h6 class='mb-0'>$cantidad</h6>";
    }
    function accion($id_empleado){
        $prop = "";
        
        if(!empty($id_empleado)){
            $prop = "<a class='dropdown-item' id='X$id_empleado' data-idempleado='$id_empleado' onclick='propiedadPersonal(event)'><i class='icon-clippy'></i> Propiedades</a>";
        }
    return "<div class='list-icons'>
                <div class='dropdown'>
                        <a href='#' class='list-icons-item' data-toggle='dropdown'>
                            <i class='icon-menu7'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right bg-slate-600'>
                            $prop
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item'><i class='icon-gear'></i> One more separated line</a>
                        </div>
                </div>
        </div>";
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