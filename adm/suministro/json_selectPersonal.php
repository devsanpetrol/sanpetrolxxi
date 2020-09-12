<?php
    require_once './suministro.php'; 
    
    $catalogo = new suministro();
    $categorias = $catalogo->get_personal("");
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("nombre" => $valor['nombre'],
                        "apellidos" => $valor['apellidos'],
                        "cargo" => $valor['cargo'],
                        "especialista" => $valor['especialista'],
                        "email" => $valor['email'],
                        "depto" => $valor['departamento'],
                        "departamento" => departamento($valor['departamento']),
                        "accion" => accion($valor['id_empleado'])
                        );
        
    }
    function cantidad_unidad($cantidad,$unidad){
        return "<h6 class='mb-0'>$cantidad</h6>
                <div class='font-size-sm text-muted line-height-1'>$unidad</div>";
    }
    function articulo_marca($articulo,$marca){
        $articulo_ = mb_strtoupper($articulo);
        $marca_ = mb_strtoupper($marca);
        if(!empty($marca_)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$articulo_</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $marca_</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$articulo_</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-slate-300 mr-1'></span> $marca_</div>
                        </div>
                    </div>";
        }
    }
    function serie_inventario($no_serie,$no_inventario){
        if(!empty($no_serie)){
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$no_inventario</a>
                            <div class='text-muted font-size-sm'><span class='badge badge-mark border-blue mr-1'></span> $no_serie</div>
                        </div>
                    </div>";
        }else{
            return "<div class='d-flex align-items-center'>
                        <div>
                            <a class='text-default font-weight-semibold letter-icon-title'>$no_inventario</a>
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