<?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $categorias = $suministro->get_almacen_reporte_movimientos($fecha_inicio,$fecha_fin);
    $data = array();
    
    foreach ($categorias as $valor) {
        $data[] = array("fecha" => $valor['fecha_movimiento'],
                        "cod_articulo" => $valor['cod_articulo'],//ok
                        "descripcion" => $valor['descripcion'],//ok
                        "marca" => $valor['marca'],//ok
                        "responsable" => $valor['responsable'],//ok
                        "condicion" => $valor['condicion'],//ok
                        "motivo" => $valor['motivo'],//ok
                        "ubicacion" => $valor['ubicacion']//ok
                        );        
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
                        </div>
                    </div>";
        }
    }
    
    function grupo($grupo){
        if(!empty($grupo)){
            return "<a class='text-primary-800 font-weight-semibold letter-icon-title mb-0'>$grupo</a>";
        }
    }
    function nombre_categoria($nombre_categoria){
        return "<h6 class='mb-0 font-size-sm font-weight-bold text-primary-800'>$nombre_categoria</h6>";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);