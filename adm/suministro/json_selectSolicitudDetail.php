 <?php
    require_once './suministro.php'; 
    
    $suministro = new suministro();
    $folio = $_POST["folio"];
    $solicitud = $suministro->get_solicitudes_("WHERE folio = $folio LIMIT 1");//SELECT * FROM adm_view_solicitud $filtro
    $data = array();
    
    $data[] = array("nombre_generico" => $solicitud[0]['nombre_generico'],
                    "nombre_solicitante" => $solicitud[0]['nombre_solicitante'],
                    "puesto_solicitante" => $solicitud[0]['puesto_solicitante'],
                    "fecha" => fecha($solicitud[0]['fecha']),
                    "sitio_operacion" => $solicitud[0]['sitio_operacion'],
                    "status" => $solicitud[0]['status'],
                    "firm_coordinacion" => $solicitud[0]['firm_coordinacion'],
                    "firm_planeacion" => $solicitud[0]['firm_planeacion'],
                    "firm_almacen" => $solicitud[0]['firm_almacen'],
                    "fecha_firm_coordinacion" => $solicitud[0]['fecha_firm_coordinacion'],
                    "fecha_firm_planeacion" => $solicitud[0]['fecha_firm_planeacion'],
                    "fecha_firm_almacen" => $solicitud[0]['fecha_firm_almacen'],
                    "clave_solicita" => $solicitud[0]['clave_solicita'],
                    "id_equipo" => $solicitud[0]['id_equipo'],
                    "coordinacion" => $solicitud[0]['coordinacion'],
                    "coordinacion_up" => ucwords(mb_strtolower($solicitud[0]['coordinacion'])),
                    "id_coordinacion" => $solicitud[0]['id_coordinacion'],
                    "folio" => $solicitud[0]['folio'],
                    "solicitud_rapida" => $solicitud[0]['solicitud_rapida']
                    );
    
    function t_icon_x($st){
       $status = array(
            "<i class='mi-adjust font-size-xl font-weight-bold text-primary-700 mr-2' title='Nuevo'></i>",//NO revisado
            "<i class='mi-done font-size-xl font-weight-bold text-success mr-2' title='Aprobado'></i>",
            "<i class='icon-cross2 font-size-base text-danger mr-2' title='Cancelado'></i>",
            "<i class='icon-eye8 font-size-base text-warning mr-2' title='En revisión'></i>",
            "<i class='icon-cart font-size-base text-slate-800 mr-2' title='Enviado a compra'></i>",
            "<i class='icon-bell3 font-size-base text-pink mr-2' title='Listo entrega'></i>",
            "<i class='icon-clipboard2 font-size-base text-slate-800 mr-2' title='Entregado'></i>",
            "<span class='badge badge-mark bg-primary border-primary'></span>",//Comentario
            "<span class='badge badge-mark bg-danger-400 border-danger-400'></span>",
            "<span class='badge badge-mark bg-violet-400 border-violet-400'></span>",
            "<span class='badge badge-mark bg-indigo-800 border-indigo-800'></span>"
        );
        return $status[$st];
    }
    function fecha($fecha){
        $date = new DateTime($fecha);
        return $date->format('F d (ga)');
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    
    